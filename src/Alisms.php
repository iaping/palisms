<?php
/**
 * 阿里大于Client
 *
 * User: aping
 * Date: 2017/6/15
 * Time: 22:52
 */

namespace Palisms;

use Exception;
use GuzzleHttp\Client;
use Palisms\Exception\PalismsException;
use Palisms\Request\Request;
use Palisms\Response\Response;
use Palisms\Response\Sms\NumQueryResponse;
use Palisms\Response\Sms\NumSendResponse;
use Palisms\Response\ErrorResponse;
use GuzzleHttp\Psr7\Response as HttpResponse;

class Alisms
{
    /**
     * Palisms version
     *
     * @var string
     */
    const VERSION = '1.0@dev';

    /**
     * 正式网关
     *
     * @var string
     */
    const GATEWAY_HTTP = 'http://gw.api.taobao.com/router/rest';

    /**
     * 配置
     *
     * @var Parameter
     */
    private $config;

    /**
     * HTTP
     *
     * @var Client
     */
    private $http;

    /**
     * 请求对象
     *
     * @var Request
     */
    private $request;

    /**
     * 响应对象
     *
     * @var Response
     */
    private $response;

    /**
     * Alipay constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = new Parameter($config);
    }

    /**
     * 请求阿里大于接口
     *
     * @param Request $request
     * @param callable|null $callback
     * @return Parameter|Response
     * @throws PalismsException
     */
    public function request(Request $request, callable $callback = null)
    {
        $this->request = $request->initParameters($this->config)->sign($this->config->secret);

        try {
            $res = $this->createHttpClient()->post(self::GATEWAY_HTTP, [
                'form_params' => $this->request->data(),
            ]);
        } catch (Exception $exception) {
            throw new PalismsException($exception->getMessage());
        }

        $this->response = $this->convertResponse($res);

        if ($this->response instanceof ErrorResponse) {
            throw new PalismsException($this->response);
        }

        return is_callable($callback) ? $callback($this->request, $this->response) : $this->response;
    }

    /**
     * json转Response
     *
     * @param HttpResponse $response
     * @return Parameter
     */
    protected function convertResponse(HttpResponse $response)
    {
        $map = $this->responseMap();

        foreach ($this->parseResponse($response) as $key => $value) {
            if (! is_array($value)) {
                throw new PalismsException('无法转换对象，联系作者');
            }

            if (isset($map[$key])) {
                return new $map[$key]($value);
            }

            break;
        }

        return new Parameter($value);
    }

    /**
     * 解析数据
     *
     * @param HttpResponse $response
     * @return mixed
     * @throws PalismsException
     */
    protected function parseResponse(HttpResponse $response)
    {
        if (($code = $response->getStatusCode()) !== 200) {
            throw new PalismsException(sprintf('与服务器通信错误（HTTP %d）', $code));
        }

        return EncryptionDecryption::json_decode($response->getBody()->getContents(), true, '无法解析服务器数据');
    }

    /**
     * 当前请求
     *
     * @return Request
     */
    public function currentRequest()
    {
        return $this->request;
    }

    /**
     * 当前响应
     *
     * @return Response
     */
    public function currentResponse()
    {
        return $this->response;
    }

    /**
     * Response map
     *
     * @return array
     */
    protected function responseMap()
    {
        return [
            ErrorResponse::MATCH_STRING     => ErrorResponse::class,
            NumSendResponse::MATCH_STRING   => NumSendResponse::class,
            NumQueryResponse::MATCH_STRING  => NumQueryResponse::class,
        ];
    }

    /**
     * HTTP Client
     *
     * @return Client
     */
    protected function createHttpClient(array $config = [])
    {
        if (! $this->http instanceof Client) {
            $this->http = new Client($config + [
                'verify' => false,
            ]);
        }

        return $this->http;
    }

    /**
     * Palipay version
     *
     * @return string
     */
    public function version()
    {
        return self::VERSION;
    }

}