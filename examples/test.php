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

$send = new \Palisms\Request\Sms\Send();
$send->setSmsFreeSignName('测试');
$send->setRecNum(['18870887449']);
$send->setSmsTemplateCode('SMS_16890021');

$alisms->request($send);

print_r($alisms->currentRequest()->data());