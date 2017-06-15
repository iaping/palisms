<?php
/**
 * 请求类
 *
 * User: APING
 * Date: 2017/06/15
 * Time: 22:24
 */

namespace Palisms\Request;

use Palisms\EncryptionDecryption;
use Palisms\Exception\PalismsException;

abstract class Request extends Parameter
{
    /**
     * 初始参数
     *
     * @param array $parameter
     * @return $this
     */
    public function initParameters(array $parameter = [])
    {
        $defaults = [
            'format'        => 'json',                      //响应格式。默认为xml格式，可选值：json
            'sign_method'   => 'md5',                       //签名的摘要算法，可选值为：md5
            'timestamp'     => date('Y-m-d H:i:s'),         //发送请求的时间
            'v'             => '2.0',
        ];

        foreach ($parameter + $defaults as $key => $value) {
            $this->set($key, $value);
        }

        $this->set('method', $this->method());

        return $this;
    }

    /**
     * 加签
     *
     * @return $this
     */
    public function sign()
    {
        $this->set('sign', EncryptionDecryption::sign($this->ksort()->data(), '123456'));

        return $this;
    }

    /**
     * 检查必要参数
     *
     * @return $this
     * @throws PalismsException
     */
    public function isValid()
    {
        if (! $this->app_key) {
            throw new PalismsException('AppKey未设置');
        }

        if (! in_array($this->format, ['json'])) {
            throw new PalismsException('响应格式只支持json');
        }

        if (! in_array($this->sign_method, ['md5'])) {
            throw new PalismsException('签名的摘要算法只支持md5');
        }

        if ($this->v !== '2.0') {
            throw new PalismsException('API协议版本只支持2.0');
        }

        return $this;
    }

    /**
     * API方法名称
     *
     * @return string
     */
    abstract public function method();

}