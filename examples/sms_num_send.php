<?php
/**
 * 模板短信发送
 *
 * User: aping
 * Date: 2017/6/14
 * Time: 17:03
 */

require '../vendor/autoload.php';

$data = [
    'app_key'   => '27651236',                          //AppKey
    'secret'    => '2441f65432738517a34d1dbb95707bda',  //通信密钥
];

//----- 用法1，快速用法 -----------------------------------------------------

\Palisms\Fast::smsNumSend($data, function ($request) {
    //请求
    $request->setRecNum(['13000000000']);
    $request->setSmsFreeSignName('易开发');
    $request->setSmsTemplateCode('SMS_71365710');
    $request->setSmsParam(['code'=>'654321']);

}, function ($request, $response) {
    //成功后回调

    //请求
    print_r($request);
    //响应
    print_r($response);

    //print_r($response->getModel());
    //var_dump($response->isSuccess());
});


exit(0);


//----- 用法2，基本用法 -----------------------------------------------------

$alisms = new \Palisms\Alisms($data);

$send = new \Palisms\Request\Sms\NumSendRequest();
$send->setSmsFreeSignName('易开发');
$send->setRecNum(['13000000000']);
$send->setSmsTemplateCode('SMS_71365710');
$send->setSmsParam(['code'=>'123456']);

$alisms->request($send, function ($request, $response) {
    //成功后回调

    //请求
    print_r($request);
    //响应
    print_r($response);

    //print_r($response->getModel());
    //var_dump($response->isSuccess());
});