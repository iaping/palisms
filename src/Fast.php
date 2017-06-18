<?php
/**
 * 快速使用Palisms
 *
 * User: APING
 * Date: 2017/6/18
 * Time: 14:45
 */

namespace Palisms;

use Palisms\Request\Sms\NumQueryRequest;
use Palisms\Request\Sms\NumSendRequest;
use Palisms\Response\Response;

class Fast
{
    /**
     * 向指定手机号码发送模板短信
     * * $data = [
     *      //必须
     *      'app_key'               => '24481160',                          //AppKey
     *      'secret'                => '2441958912738547a34d1dbb95707bd1',  //通信密钥
     * ]
     *
     * @param array $data
     * @param callable $reqCall
     * @param callable|null $resCall
     * @return Parameter|Response
     */
    public static function smsNumSend(array $data, callable $reqCall, callable $resCall = null)
    {
        $reqCall($request = new NumSendRequest());

        return self::alisms($data)->request($request, $resCall);
    }

    /**
     * 短信发送记录查询
     * $data = [
     *      //必须
     *      'app_key'   => '24481160',                          //AppKey
     *      'secret'    => '2441958912738547a34d1dbb95707bd1',  //通信密钥
     * ]
     *
     * @param array $data
     * @param callable $reqCall
     * @param callable|null $resCall
     * @return Parameter|Response
     */
    public static function smsNumQuery(array $data, callable $reqCall, callable $resCall = null)
    {
        $reqCall($request = new NumQueryRequest());

        return self::alisms($data)->request($request, $resCall);
    }

    /**
     * alisms instance
     *
     * @param array $data
     * @return Alisms
     */
    public static function alisms(array $data)
    {
        return new Alisms($data);
    }

}