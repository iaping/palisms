<?php
/**
 * 请求类
 *
 * User: APING
 * Date: 2017/06/15
 * Time: 22:24
 */

namespace Palisms\Request;

use Palisms\Parameter;
use Palisms\Exception\PalismsException;

abstract class Request extends Parameter
{
    /**
     * AccessKey
     *
     * @param string $accessKeyId
     * @return $this
     */
    public function setAccessKeyId($accessKeyId)
    {
        return $this->set('AccessKeyId', $accessKeyId);
    }

    /**
     * 初始参数
     *
     * @param Parameter $parameter
     * @return $this
     */
    public function initParameters(Parameter $parameter)
    {
        $defaultTimezone = date_default_timezone_get();
        date_default_timezone_set('GMT');

        $defaults = [
            'Timestamp'         => date('Y-m-d\TH:i:s\Z'),//格式为：yyyy-MM-dd’T’HH:mm:ss’Z’；时区为：GMT
            'Format'            => 'JSON',                      //响应格式。只能json
            'SignatureMethod'   => 'HMAC-SHA1',                 //建议固定值：HMAC-SHA1
            'SignatureVersion'  => '1.0',                       //建议固定值：1.0
            'SignatureNonce'    => uniqid(),
        ];

        date_default_timezone_set($defaultTimezone);

        foreach ($parameter->except('AccessKeySecret') + $defaults as $key => $value) {
            $this->set($key, $value);
        }

        $this->set('Action', $this->action())->set('Version', '2017-05-25')->set('RegionId', 'cn-hangzhou');

        return $this;
    }

    /**
     * 加签
     *
     * @return $this
     */
    public function signature($secret)
    {
        if (! $secret) {
            throw new PalismsException('通信密钥未设置(secret)');
        }

        return $this->valid()->set('Signature', $this->hmac($this->ksort()->data(), $secret . '&'));
    }

    /**
     * hmac签名串
     *
     * @param array $data
     * @param $secret
     * @return string
     */
    protected function hmac(array $data, $secret)
    {
        //var_dump($this->signRaw($data));exit;
        return base64_encode(hash_hmac('sha1', $this->signRaw($data), $secret, true));
    }

    /**
     * 签名原串
     *
     * @param array $data
     * @return string
     */
    protected function signRaw(array $data)
    {
        $str = '';

        foreach ($data as $key => $val) {
            $str .= '&' . $this->percentEncode($key). '=' . $this->percentEncode($val);
        }

        return 'POST&%2F&' . $this->percentEncode(substr($str, 1));
    }

    /**
     * urlencode特殊字符替换
     *
     * @param $str
     * @return mixed|string
     */
    protected function percentEncode($str)
    {
        $res = urlencode($str);
        $res = preg_replace('/\+/', '%20', $res);
        $res = preg_replace('/\*/', '%2A', $res);
        $res = preg_replace('/%7E/', '~', $res);

        return $res;
    }

    /**
     * 验证
     *
     * @return $this
     * @throws PalismsException
     */
    public function valid()
    {
        if (! $this->AccessKeyId) {
            throw new PalismsException('AccessKeyId未设置(AccessKeyId)');
        }

        $this->check();

        return $this;
    }

    abstract protected function action();

    /**
     * 检查
     *
     * @return void
     */
    abstract protected function check();

}