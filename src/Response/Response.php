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
    public function valid()
    {

    }

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
     * 请求编号
     *
     * @return mixed|void
     */
    public function getRequestId()
    {
        return $this->request_id;
    }

}