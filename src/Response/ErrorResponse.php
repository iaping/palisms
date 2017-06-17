<?php
/**
 * 错误响应
 *
 * User: APING
 * Date: 2017/6/17
 * Time: 20:46
 */

namespace Palisms\Response;

class ErrorResponse extends Response
{
    /**
     * 匹配字符串
     *
     * @var string
     */
    const MATCH_STRING = 'error_response';

    /**
     * 错误编号
     *
     * @return integer
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * 错误信息
     *
     * @return string
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * 错误码
     *
     * @return string
     */
    public function getSubCode()
    {
        return $this->sub_code;
    }

    /**
     * 错误描述
     *
     * @return mixed|void
     */
    public function getSubMsg()
    {
        return $this->sub_msg;
    }

    /**
     * toString
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s(%s)', $this->getSubMsg() ?: $this->getMsg(), $this->getSubCode() ?: $this->getCode());
    }

}