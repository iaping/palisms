<?php
/**
 * 模板短信发送
 *
 * User: aping
 * Date: 2017/6/14
 * Time: 17:03
 */

require '../vendor/autoload.php';

$alisms = new \Palisms\Alisms([
    'app_key' => '23471566',
    'secret' => '2441f58932738517a34d1dbb95707bda',
]);

$send = new \Palisms\Request\Sms\NumSendRequest();
$send->setSmsFreeSignName('易开发');
$send->setRecNum(['18870887449']);
$send->setSmsTemplateCode('SMS_71365710');
$send->setSmsParam(['code'=>'123456']);

$alisms->request($send, function ($request, $response) {
    print_r($request);
    print_r($response);

    print_r($response->getModel());
    var_dump($response->isSuccess());
});