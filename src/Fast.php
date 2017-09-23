<?php
/**
 * 快速使用Palisms
 *
 * User: APING
 * Date: 2017/9/23
 * Time: 14:45
 */

namespace Palisms;

use Palisms\Request\V20170525\SendRequest;
use Palisms\Response\Response;

class Fast
{
    /**
     * 向指定手机号码发送模板短信
     * * $config = [
     *      //必须
     *      'AccessKeyId'       => '24481160',
     *      'AccessKeySecret'   => '2441958912738547a34d1dbb95707bd1',
     * ]
     *
     * @param array $config
     * @param callable $reqCall
     * @param callable|null $resCall
     * @return Parameter|Response
     */
    public static function smsSend(array $config, callable $reqCall, callable $resCall = null)
    {
        $reqCall($request = new SendRequest());

        return self::alisms($config)->request($request, $resCall);
    }

    /**
     * alisms instance
     *
     * @param array $data
     * @return Alisms
     */
    public static function alisms(array $config)
    {
        return new Alisms($config);
    }

}