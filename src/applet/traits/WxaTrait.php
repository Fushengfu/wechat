<?php
namespace Fushengfu\Wechat\applet\traits;

trait WxaTrait {
  /**
   * 获取插件用户openpid
   */
  public function getpluginopenpid(array $data)
  {
    $this->httpPost('/wxa/getpluginopenpid?access_token='.$this->getAccessToken(), json_encode($data));
    return $this->getResponse();
  }

  /**
   * 检查加密信息
   */
  public function checkencryptedmsg(array $data)
  {
    $this->httpPost('/wxa/business/checkencryptedmsg?access_token='.$this->getAccessToken(), json_encode($data));
    return $this->getResponse();
  }

  /**
   * 支付后获取 Unionid
   */
  public function getpaidunionid()
  {
    $this->httpGet('/wxa/getpaidunionid?access_token='.$this->getAccessToken());
    return $this->getResponse();
  }

  /**
   * 获取用户encryptKey
   */
  public function getuserencryptkey(array $data)
  {
    $this->httpPost('/wxa/business/getuserencryptkey?access_token='.$this->getAccessToken(), json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取手机号
   */
  public function getuserphonenumber(array $data)
  {
    $this->httpPost('/wxa/business/getuserphonenumber?access_token='.$this->getAccessToken(), json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取小程序码
   */
  public function getwxacode(array $data)
  {
    $this->httpPost('/wxa/getwxacode?access_token='.$this->getAccessToken(), json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取不限制的小程序码
   */
  public function getwxacodeunlimit(array $data)
  {
    $this->httpPost('/wxa/getwxacodeunlimit?access_token='.$this->getAccessToken(), json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取小程序二维码
   */
  public function createwxaqrcode(array $data)
  {
    $this->httpPost('/cgi-bin/wxaapp/createwxaqrcode?access_token='.$this->getAccessToken(), json_encode($data));
    return $this->getResponse();
  }
}