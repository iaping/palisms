<?php
/**
 * 短信发送记录查询
 * https://api.alidayu.com/docs/api.htm?spm=a3142.7395905.4.7.8Rdvsl&apiId=26039
 *
 * User: APING
 * Date: 2017/6/18
 * Time: 10:49
 */

namespace Palisms\Request\Sms;

use Palisms\Request\Request;

class NumQueryRequest extends Request
{
    /**
     * impl
     *
     * @return string
     */
    public function method()
    {
        return 'alibaba.aliqin.fc.sms.num.query';
    }

    /**
     * 短信发送流水
     * 如：1234^1234
     *
     * @param string $bizId
     * @return $this
     */
    public function setBizId($bizId)
    {
        return $this->set('biz_id', $bizId);
    }

    /**
     * 短信接收号码
     * 如：13000000000
     *
     * @param string $recNum
     * @return $this
     */
    public function setRecNum($recNum)
    {
        return $this->set('rec_num', $recNum);
    }

    /**
     * 短信发送日期，支持近30天记录查询
     * 格式yyyyMMdd，如：20151215
     *
     * @param string $queryDate
     * @return $this
     */
    public function setQueryDate($queryDate)
    {
        return $this->set('query_date', $queryDate);
    }

    /**
     * 分页参数,页码
     * 如：1
     *
     * @param integer $currentPage
     * @return $this
     */
    public function setCurrentPage($currentPage = 1)
    {
        $currentPage = (int) ($currentPage < 0 ? 1 : $currentPage);

        return $this->set('current_page', $currentPage);
    }

    /**
     * 分页参数，每页数量。最大值50
     * 如：10
     *
     * @param integer $pageSize
     * @return $this
     */
    public function setPageSize($pageSize = 10)
    {
        $pageSize = (int) ($pageSize < 0 ? 1 : ($pageSize > 50 ? 50 : $pageSize));

        return $this->set('page_size', $pageSize);
    }

    /**
     * impl
     *
     * @return void
     */
    protected function init()
    {
        if (is_null($this->query_date)) {
            $this->setQueryDate(date('Ymd'));
        }

        if (is_null($this->current_page)) {
            $this->setCurrentPage();
        }

        if (is_null($this->page_size)) {
            $this->setPageSize();
        }
    }

    protected function check()
    {
        // TODO: Implement check() method.
    }

}