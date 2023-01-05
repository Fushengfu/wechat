<?php

namespace Fushengfu\Wechat;

/**
 * 微信基础类
 */
abstract class Wechat {

  protected $http;

  protected $appid;

	protected $secret;

  /**
   * 接口基础域名
   */
  protected $baseUrl;

  /**
   * 获取access_token
   */
  abstract function getAccessToken(): string;

  /**
   * 获取客户端
   */
  public function getClient()
  {
    if ($this->http == null) {
      $this->http = new Request();
    }

    return $this;
  }

  /**
   * 获取appid
   */
  public function getAppid(): string
  {
    var_dump(get_object_vars($this));
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
  public function httpPost()
  {
    // $this->handleErrors();
  }

  /**
   * 网络请求
   */
  public function httpGet($uri)
  {
    var_dump(func_get_args());
    $this->sendForm('get', $uri);
  }

  /**
   * 网络接口请求
   */
  public function sendForm($method, $uri, $options = [])
  {
    $this->handleBefore();
    $this->http->{$method}($uri, $options);
    $this->handleErrors();
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