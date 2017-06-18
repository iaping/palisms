<?php
/**
 * 响应基类
 *
 * User: APING
 * Date: 2017/6/17
 * Time: 20:46
 */

namespace Palisms\Response;

use Palisms\Parameter;

abstract class Response extends Parameter
{
    /**
     * 返回值
     *
     * @return array
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * 是否成功
     *
     * @return bool
     */
    public function isSuccess()
    {
        return (bool) $this->getResult()['success'];
    }

    /**
     * 请求编号
     *
     * @return mixed|void
     */
    public function getRequestId()
    {
        return $this->request_id;
    }

}