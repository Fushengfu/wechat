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
   * 异常状态码
   */
  protected $errcode = 0;

  /**
   * 错误信息
   */
  protected $errmsg;

  /**
   * 接口基础域名
   */
  protected $baseUrl;

  const OK = 0;

  /**
   * 获取access_token
   */
  abstract function getAccessToken(): string;

  abstract function getErrText(): void;

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
  protected function handleFinish()
  {
    $response = $this->toArray();

    /**
     * 请求接口返回异常状态码
     */
    if ($response['errcode']??false) {
      $this->errcode = $response['errcode'];
    }

    /**
     * 请求接口返回错误信息
     */
    if ($response['errmsg']??false) {
      $this->errmsg = $response['errmsg'];
      $this->getErrText();
    }

    // echo "接口请求后调用\n";
    // var_dump($this->http->getRequestHeaders());
    // var_dump($this->getErrText());
  }

  /**
   * 请求前调用
   */
  protected function handleBefore($uri, $params)
  {
    $this->errcode = 0;
    $this->errmsg = null;
    // echo "接口请求前调调用\n";
    // echo $uri.PHP_EOL;
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
    /**
     * 请求前操作
     */
    $this->handleBefore($this->baseUrl.$uri, $options);

    /**
     * 发情求口请求
     */
    $this->http->{$method}($this->baseUrl.$uri, $options);

    /**
     * 请求结束后操作
     */
    $this->handleFinish();

    return $this->http->getResponse();
  }

  /**
   * 获取当前错误码
   */
  public function getErrcode()
  {
    return $this->errcode;
  }

  /**
   * 获取当前错误码
   */
  public function getErrmsg()
  {
    return $this->errmsg;
  }

  /**
   * 获取当前状态码
   */
  public function getStatusCode()
  {
    return $this->http->getStatusCode();
  }

  /**
   * 获取原始响应数据
   */
  public function getResponse()
  {
    return $this->http->getResponse();
  }

  /**
   * 确认接口调用是否成功
   */
  public function Ok()
  {
    return $this->getStatusCode() == 200 && $this->successCode() == $this->getErrcode();
  }

  /**
   * 成功响应码
   */
  public function successCode()
  {
    return self::OK;
  }

  /**
   * 转数组
   */
  public function toArray()
  {
    return $this->http->toArray();
  }

  /**
   * 转json
   */
  public function toJson(bool $outofjson = false)
  {
    return $this->http->toJson($outofjson);
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