<?php

namespace Fushengfu\Wechat\work;

use Fushengfu\Wechat\Wechat;
use Fushengfu\Wechat\work\traits\{
  Service
};


class Application extends Wechat {
  /**
   * 企业配置
   */
  protected $appid;

	protected $secret;

  protected $agentid;

	protected $accessToken;

  /**
   * 第三方应用
   */
	protected $suiteId;//第三方应用id

	protected $suiteSecret;//第三方应用secret 或者代开发应用模板secret

  protected $suiteTicket;//企业微信后台推送的ticket

  protected $preAuthCode;//预授权码

  protected $permanentCode;//企业微信永久授权码

  protected $suiteAccessToken;//第三方或者代开发应用access_token

  protected $encodingAesKey;

	/**
	 * 代理IP
	 */
	public $proxyHost = null;

	/**
	 * 代理端口
	 */
	public $proxyPort = 0;

  use Service;

  /**
   * 构造函数
   */
  public function __construct(array $config)
  {
    $this->initConfig($config);
  }

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
  }

  /**
   * 获取access_token
   */
  public function getAccessToken(): string
  {
    if ($this->suiteAccessToken) {
      return $this->suiteAccessToken;
    }
    
    $this->http->post($this->baseUrl.'/cgi-bin/service/get_suite_token', json_encode([
      "suite_id"=> $this->suiteId,
      "suite_secret"=> $this->suiteSecret,
      "suite_ticket"=> $this->suiteTicket
    ]));
    var_dump($this->http->getRequestHeaders());
    return $this->http->getResponse();
  }

  /**
   * 设置suiteAccessToken
   */
  public function setSuiteAccessToken(string $suiteAccessToken)
  {
    $this->suiteAccessToken = $suiteAccessToken;
  }

  /**
   * 防止克隆
   */
  private function __clone(){}
}