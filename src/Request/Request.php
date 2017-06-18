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
     * TOP分配给应用的AppKey
     *
     * @param string $appKey
     * @return $this
     */
    public function setAppKey($appKey)
    {
        return $this->set('app_key', $appKey);
    }

    /**
     * 被调用的目标AppKey
     * 仅当被调用的API为第三方ISV提供时有效
     *
     * @param string $targetAppKey
     * @return $this
     */
    public function setTargetAppKey($targetAppKey)
    {
        return $this->set('target_app_key', $targetAppKey);
    }

    /**
     * 用户登录授权成功后，TOP颁发给应用的授权信息
     * 当此API的标签上注明：“需要授权”，则此参数必传；“不需要授权”，则此参数不需要传；“可选授权”，则此参数为可选。
     * http://open.taobao.com/docs/doc.htm?spm=a3142.7395905.4.26.YFnuhE&docType=1&articleId=102635&treeId=1
     *
     * @param string $session
     * @return $this
     */
    public function setSession($session)
    {
        return $this->set('session', $session);
    }

    /**
     * 合作伙伴身份标识
     *
     * @param string $partnerId
     * @return $this
     */
    public function setPartnerId($partnerId)
    {
        return $this->set('partner_id', $partnerId);
    }

    /**
     * 初始参数
     *
     * @param Parameter $parameter
     * @return $this
     */
    public function initParameters(Parameter $parameter)
    {
        $defaults = [
            'format'        => 'json',                      //响应格式。默认为xml格式，可选值：json
            'sign_method'   => 'md5',                       //签名的摘要算法，可选值为：md5
            'timestamp'     => date('Y-m-d H:i:s'),         //发送请求的时间
            'v'             => '2.0',
        ];

        foreach ($parameter->except('secret') + $defaults as $key => $value) {
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
    public function sign($secret)
    {
        if (! $secret) {
            throw new PalismsException('通信密钥未设置(secret)');
        }

        $this->valid()->set('sign', EncryptionDecryption::sign($this->ksort()->data(), $secret));

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
            throw new PalismsException('AppKey未设置(app_key)');
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