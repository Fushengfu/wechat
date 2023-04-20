<?php

namespace Fushengfu\Wechat\applet;

use Fushengfu\Wechat\Wechat;
use Fushengfu\Wechat\applet\traits\{
  WxaTrait
};


class Application extends Wechat {

  use WxaTrait;

  /**
   * 构造函数
   */
  public function __construct(array $config)
  {
    $this->initConfig($config);
  }

  /**
   * 获取错误信息
   */
  public function getErrText(): void
  {
    $text = ErrCode::getErrText($this->getErrcode());
    if ($text) {
      $this->errmsg = $text;
    }
  }

  /**
   * 获取access_token
   */
  public function getAccessToken(): string
  {
    $uri = "/cgi-bin/token?grant_type=client_credential&appid={$this->appid}&secret={$this->secret}";
    $this->httpGet($uri);

    if ($this->Ok()) {
      $response = $this->toArray();
      $this->cache->set($this->appid.'_access_token', $this->toJson(), (int)$response['expires_in'] - 60);
    }

    return $this->getResponse();
  }

  /**
   * jscode2session
   */
  public function jscode2session(string $code)
  {
    $uri = "/sns/jscode2session?appid={$this->appid}&secret={$this->secret}&js_code={$code}&grant_type=authorization_code";
    $this->httpGet($uri);

    return $this->getResponse();
  }

  /**
   * 防止克隆
   */
  private function __clone(){}
}