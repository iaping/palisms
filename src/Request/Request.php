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

        $this->set('method', $this->method())->init();

        return $this;
    }

    /**
     * 加签
     *
     * @return $this
     */
    public function sign()
    {
        $this->valid()->set('sign', EncryptionDecryption::sign($this->ksort()->data(), '036e11b8a6de42e6732a944740e79f67'));

        return $this;
    }

    /**
     * 验证
     *
     * @return $this
     * @throws PalismsException
     */
    public function valid()
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

        $this->check();

        return $this;
    }

    /**
     * API方法名称
     *
     * @return string
     */
    abstract public function method();

    /**
     * 初始
     *
     * @return void
     */
    abstract protected function init();

    /**
     * 检查
     *
     * @return void
     */
    abstract protected function check();

}