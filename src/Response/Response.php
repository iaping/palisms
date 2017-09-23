<?php
/**
 * 响应类
 *
 * User: APING
 * Date: 2017/9/23
 * Time: 20:46
 */

namespace Palisms\Response;

use Palisms\Parameter;

class Response extends Parameter
{
    /**
     * 成功？
     *
     * @return bool
     */
    public function isSuccess()
    {
        return $this->getCode() === 'OK';
    }

    /**
     * 状态码
     * 返回OK代表请求成功,其他错误码详见错误码列表
     *
     * @return array
     */
    public function getCode()
    {
        return $this->Code;
    }

    /**
     * 状态码的描述
     *
     * @return mixed|void
     */
    public function getMessage()
    {
        return $this->Message;
    }

    /**
     * 请求ID
     *
     * @return mixed|void
     */
    public function getRequestId()
    {
        return $this->RequestId;
    }

}