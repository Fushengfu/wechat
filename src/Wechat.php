<?php

namespace Fushengfu\Wechat;

/**
 * 微信基础类
 */
abstract class Wechat {

  protected $http;

  protected $cache;

  protected $appid;

	protected $secret;

  protected $componentAppid;

  protected $componentAppsecret;

  protected $authorizerRefreshToken;

	protected $accessToken;

  protected $authorizerAccessToken;

  protected $componentVerifyTicket;

  protected $componentAccessToken;

  /**
   * 接口基础域名
   */
  protected $baseUrl;

  /**
   * 获取access_token
   */
  abstract function getAccessToken(): string;

  /**
   * 初始化配置
   */
  public function initConfig(array $options)
  {
    $proertys = get_object_vars($this);
    
    foreach ($proertys as $key => $value) {
      if (isset($options[$key])) {
        $this->{$key} = $options[$key];
      }
    }

    if ($this->http == null) {
      $this->http = new Request();
    }

    if ($this->cache == null) {
      $this->cache = new Cache();
    }
  }

  /**
   * 获取客户端
   */
  public function getClient()
  {
    return $this;
  }

  /**
   * 获取appid
   */
  public function getAppid(): string
  {
    return $this->appid??null;
  }

  /**
   * 异常处理
   */
  protected function handleErrors()
  {
    echo "接口请求后调用\n";
  }

  /**
   * 请求前调用
   */
  protected function handleBefore()
  {
    echo "接口请求前调调用\n";
  }

  /**
   * 网络请求
   */
  public function httpPost($uri, $options = [])
  {
    return $this->sendForm('post', $uri, $options);
  }

  /**
   * 网络请求
   */
  public function httpGet($uri)
  {
    return $this->sendForm('get', $uri);
  }

  /**
   * 网络接口请求
   */
  public function sendForm($method, $uri, $options = [])
  {
    $this->handleBefore();
    $this->http->{$method}($this->baseUrl.$uri, $options);
    $this->handleErrors();

    return $this->http->getResponse();
  }

  /**
   * 非法调用
   */
  public function __call($name, $arguments)
  {
    $arguments = json_encode($arguments);
    echo "请求的{$name}方法,参数{$arguments}不存在\n";
  }
}