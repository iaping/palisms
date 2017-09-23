阿里云通信SDK PHP版
=======================

[![composer](https://img.shields.io/badge/composer-aping/palisms-red.svg?maxAge=2592000)](https://packagist.org/packages/aping/palisms)
[![php>=5.5](https://img.shields.io/badge/php->%3D5.5-orange.svg?maxAge=2592000)](https://packagist.org/packages/aping/palisms)
[![size](https://img.shields.io/badge/size-25%20KB-green.svg)](https://packagist.org/packages/aping/palisms)
[![license=MIT](https://img.shields.io/badge/license-MIT-blue.svg?maxAge=2592000)](https://packagist.org/packages/aping/palisms)

Palisms SDK是实现阿里云通信相关API的一个PHP开发库，便于集成需要短信服务的应用。

阿里大鱼老用户请使用[V1](https://github.com/git-aping/palisms/tree/v1)版本。

- 用法简单，提供\Palisms\Fast类快速使用已开发的接口~
- 注释多多，主要来自官方文档~
- 面向对象，代码结构清晰，阅读无障碍~
- 应该还有，我再想想~

## API（完成）

- `通过` [短信发送](docs/短信发送.md)

## 安装

```bash
php composer.phar require aping/palisms
```
或
```bash
"require": {
    "aping/palisms": "dev-master"
}
```

## 用法

> 配置去阿里云控制台拿~

```php
$config = [
    'AccessKeyId'       => 'AccessKeyId',
    'AccessKeySecret'   => 'AccessKeySecret',
];
```

> 发送模板短信（推荐）

```php
\Palisms\Fast::smsSend($data, function (SendRequest $request) {
    //请求
    $request->setRecNum(['13000000000']);
    $request->setSmsFreeSignName('易开发');
    $request->setSmsTemplateCode('SMS_71365710');
    $request->setSmsParam(['code'=>'654321']);

}, function (SendRequest $request, Response $response) {
    // 成功后才会回调

    // 请求 NumSendRequest
    // print_r($request);
    
    // 响应 NumSendResponse
    // print_r($response);
    
    // 直接转json方便保存请求和响应的数据
    // echo $request;
    // echo $response;
    
    // 相关方法
    // var_dump($response->isSuccess());
});
```

直接COPY例子，examples下面有使用例子，随便查看~

## 帮助

- BUG反馈：https://github.com/git-aping/palisms/issues
- API文档：https://api.alidayu.com/doc2/apiList.htm
- e-mail：czp010443@aliyun.com

## 最后

- 如果Palisms SDK帮助到你，请给个Star~
- 业余时间会继续完善API、Doc、Test等~
- 不用买咖啡~