<?php
/**
 * 模板短信发送
 *
 * User: aping
 * Date: 2017/6/14
 * Time: 17:04
 */

require '../vendor/autoload.php';

use Palisms\Request\V20170525\SendRequest;
use Palisms\Response\Response;

$config = [
    'AccessKeyId'       => 'AccessKeyId',
    'AccessKeySecret'   => 'AccessKeySecret',
];

\Palisms\Fast::smsSend($config, function (SendRequest $request) {
    //请求
    $request->setPhoneNumbers(['18888888888']);
    $request->setSignName('签名');
    $request->setTemplateCode('SMS_88888888');
    $request->setTemplateParam(['code'=>'ABC123']);

}, function (SendRequest $request, Response $response) {
    //成功后回调

    //请求
    print_r($request);
    //响应
    print_r($response);

    print_r($response->isSuccess());
});
