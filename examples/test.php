<?php
/**
 * Created by PhpStorm.
 * User: aping
 * Date: 2017/6/14
 * Time: 17:03
 */

require '../vendor/autoload.php';

$alisms = new \Palisms\Alisms([
    'app_key' => '23471938',
]);

/*print_r(array_column(json_decode('{
        "result": {
            "err_code": "0",
            "model": "108169529513^1111039767842",
            "success": true
        },
        "request_id": "2m6jom1d7lru"
    }', true), 'request_id'));exit;*/

$send = new \Palisms\Request\Sms\NumSendRequest();
$send->setSmsFreeSignName('测试');
//$send->setSmsFreeSignName('立橙印');
$send->setRecNum(['18870887449']);
$send->setSmsTemplateCode('SMS_16890021');

print_r($alisms->request($send, function ($response) {
    var_dump($response->getModel());
    var_dump($response->isSuccess());
    return $response;
}));

print_r($alisms->currentRequest()->data());