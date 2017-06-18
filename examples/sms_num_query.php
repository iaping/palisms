<?php
/**
 * 短信发送记录查询
 *
 * User: APING
 * Date: 2017/6/18
 * Time: 11:16
 */

require '../vendor/autoload.php';

$data = [
    'app_key'   => '27651236',                          //AppKey
    'secret'    => '2441f65432738517a34d1dbb95707bda',  //通信密钥
];

//----- 用法1，快速用法（推荐） -----------------------------------------------------

\Palisms\Fast::smsNumQuery($data, function ($request) {
    //请求
    $request->setRecNum('13000000000');

    //$request->setQueryDate(date('Ymd'));
    //$request->setCurrentPage(1);
    //$request->setPageSize(10);

}, function ($request, $response) {
    //成功后回调

    //请求
    print_r($request);
    //响应
    print_r($response);

    //print_r($response->getCurrentPage());
    //print_r($response->getPageSize());
    //print_r($response->getTotalCount());
    //print_r($response->getTotalPage());
    //print_r($response->getResult());
});



exit(0);



//----- 用法2，基本用法 -----------------------------------------------------

$alisms = new \Palisms\Alisms($data);

$query = new \Palisms\Request\Sms\NumQueryRequest();
$query->setRecNum('13000000000');
$query->setQueryDate(date('Ymd'));
$query->setCurrentPage(1);
$query->setPageSize(10);

$alisms->request($query, function ($request, $response) {
    //成功后回调

    //请求
    print_r($request);
    //响应
    print_r($response);

    //print_r($response->getCurrentPage());
    //print_r($response->getPageSize());
    //print_r($response->getTotalCount());
    //print_r($response->getTotalPage());
    //print_r($response->getResult());
});