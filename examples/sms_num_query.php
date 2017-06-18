<?php
/**
 * 短信发送记录查询
 *
 * User: APING
 * Date: 2017/6/18
 * Time: 11:16
 */

require '../vendor/autoload.php';

$alisms = new \Palisms\Alisms([
    'app_key' => '23471566',
    'secret' => '2441f58932738517a34d1dbb95707bda',
]);

$query = new \Palisms\Request\Sms\NumQueryRequest();
$query->setRecNum('18870887449');
//$query->setQueryDate(date('Ymd'));
//$query->setCurrentPage('2');
//$query->setPageSize('2');

$alisms->request($query, function ($request, $response) {
    print_r($request);
    print_r($response);

    print_r($response->getCurrentPage());
    print_r($response->getPageSize());
    print_r($response->getTotalCount());
    print_r($response->getTotalPage());
    print_r($response->getValues());
});