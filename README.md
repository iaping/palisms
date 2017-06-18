阿里大于短信SDK PHP版
=======================

Palisms SDK是实现阿里大于短信相关API的一个PHP开发库，便于集成需要短信服务的应用。

- 用法简单，提供\Palisms\Fast类快速使用已开发的接口~
- 注释多多，主要来自官方文档，懒~
- 面向对象，代码结构清晰，阅读无障碍，要不你试试~
- 应该还有，我再想想~

## API（完成）

- [短信发送](examples/sms_num_send.php)
- [短信发送记录查询](examples/sms_num_query.php)

## 安装

```bash
php composer.phar require aping/palisms
```

## 用法

> 配置，去大于拿~

```php
$data = [
    'app_key'   => '24372456',                          //AppKey
    'secret'    => '2441f58932938147a34d1dbb95707bda',  //通信密钥
];
```

> 用法一（推荐），发送模板短信

```php
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
```

> 用法二，发送模板短信
```php
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
```

直接COPY，examples下面有使用例子，随便查看~

## 帮助

- BUG反馈：https://github.com/git-aping/palisms/issues
- 大于API文档：https://api.alidayu.com/doc2/apiList.htm
- e-mail：czp010443@aliyun.com

## 最后

- 如果Palisms SDK帮助到你，请给个Star~
- 业余时间会继续完善API、Doc、Test等~
- 不用买咖啡~