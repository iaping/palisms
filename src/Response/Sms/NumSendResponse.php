<?php
/**
 * 发送模板短信响应类
 *
 * User: APING
 * Date: 2017/6/17
 * Time: 20:46
 */

namespace Palisms\Response\Sms;

use Palisms\Response\Response;

class NumSendResponse extends Response
{
    /**
     * 匹配字符串
     *
     * @var string
     */
    const MATCH_STRING = 'alibaba_aliqin_fc_sms_num_send_response';

    /**
     * 返回结果（流水编号）
     *
     * @return string
     */
    public function getModel()
    {
        return $this->getResult()['model'];
    }

}