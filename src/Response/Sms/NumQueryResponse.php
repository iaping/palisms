<?php
/**
 * 短信发送记录查询响应类
 *
 * User: APING
 * Date: 2017/6/18
 * Time: 11:23
 */

namespace Palisms\Response\Sms;

use Palisms\Response\Response;

class NumQueryResponse extends Response
{
    /**
     * 匹配字符串
     *
     * @var string
     */
    const MATCH_STRING = 'alibaba_aliqin_fc_sms_num_query_response';

    /**
     * 当前页码
     *
     * @return integer
     */
    public function getCurrentPage()
    {
        return $this->current_page;
    }

    /**
     * 每页数量
     *
     * @return integer
     */
    public function getPageSize()
    {
        return $this->page_size;
    }

    /**
     * 总数
     *
     * @return integer
     */
    public function getTotalCount()
    {
        return $this->total_count;
    }

    /**
     * 总页数
     *
     * @return integer
     */
    public function getTotalPage()
    {
        return $this->total_page;
    }

    /**
     * 是否成功
     *
     * @return bool
     */
    public function isSuccess()
    {
        return true;
    }

    /**
     * 数据集合
     * 具体字段定义参考大于文档的响应参数
     * [[
     *      extend              => '公共回传参数',
     *      rec_num             => '短信接收号码',
     *      result_code         => '短信错误码',
     *      sms_code            => '模板编码',
     *      sms_content         => '短信发送内容',
     *      sms_receiver_time   => '短信接收时间',
     *      sms_send_time       => '短信发送时间',
     *      sms_status          => '发送状态 1：等待回执，2：发送失败，3：发送成功',
     * ]]
     *
     * @return array
     */
    public function getResult()
    {
        return $this->values ? $this->values['fc_partner_sms_detail_dto'] : [];
    }

}