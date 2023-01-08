# SDK使用说明

## 安装
```
composer require fushengfu/wechat
```

## 使用示例

### 1、引入命名空间工厂类
```
use Fushengfu\Wechat\Factory;
```

### 2、代码示例

```

/**
 * $object work： 企业微信 officialAccount： 公众号 pay： 微信支付 applet：小程序
 *
 */
$app = Factory::make($object, $options);

$app = Factory::make("work", [
  'corpid'=> '*******',//企业微信服务商ID
  'providerSecret'=> '3******',//企业微信服务商secret
  'baseUrl'=> 'http://******',//基础链接
  'suiteId'=>'*******',//企业微信第三方应用ID
  'suiteSecret'=>'******',//企业微信第三方应用secret
  'appid'=> '******',//企业微信 企业corpid
  'suiteTicket'=> '****',//企业微信第三方应用 ticket
  'permanentCode'=> '*****'//企业微信第三方应用授权永久授权码
]);

```

### 接口调用示例
```
//返回接口响应的原始数据
$response = $app->contactBatchSearch([
  'query_word'=> '南山南'
]);

//返回数组
$arrayResponse = $app->toArray();

//返回 200 网络请求正常
$statusCode = $app->getStatusCode();

//返回 0 则接口响应正常
$errCode = $app->getErrmsg();

//返回true 则请求成功
$ok = $app->Ok();
```
