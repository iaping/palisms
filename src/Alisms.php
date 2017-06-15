<?php
/**
 * 阿里大于Client
 *
 * User: aping
 * Date: 2017/6/15
 * Time: 22:52
 */

namespace Palisms;

use GuzzleHttp\Client;
use Palisms\Exception\PalismsException;
use Palisms\Request\Request;

class Alisms
{
    /**
     * Palisms version
     *
     * @var string
     */
    const VERSION = '1.0';

    /**
     * 正式网关
     *
     * @var string
     */
    const GATEWAY_HTTP = 'http://gw.api.taobao.com/router/rest';

    /**
     * 配置
     *
     * @var array
     */
    private $config = [];

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
     * Alipay constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     *
     */
    public function request(Request $request)
    {
        $this->request = $request->initParameters($this->config)->isValid()->sign();

        $res = $this->http()->post(self::GATEWAY_HTTP, [
            'form_params' => $this->request->data(),
        ]);

        if (($code = $res->getStatusCode()) !== 200) {
            throw new PalismsException(sprintf('与阿里大于服务器通信错误（HTTP %d）', $code));
        }

        var_dump($res->getBody()->getContents());
    }

    /**
     * 当前请求
     *
     * @return Parameter
     */
    public function currentRequest()
    {
        return $this->request;
    }

    /**
     * HTTP Client
     *
     * @return Client
     */
    protected function http(array $config = [])
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