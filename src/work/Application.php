<?php

namespace Fushengfu\Wechat\work;

use Fushengfu\Wechat\Wechat;
use Fushengfu\Wechat\work\traits\{
  ServiceTrait,
  UserTrait,
  AgentTrait,
  ExternalcontactTrait,
  MediaTrait,
  KfTrait,
  DepartmentTrait,
  TagTrait
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
   * 服务商
   */
  protected $corpid;

  protected $providerSecret;

	/**
	 * 代理IP
	 */
	public $proxyHost = null;

	/**
	 * 代理端口
	 */
	public $proxyPort = 0;

  use ServiceTrait,
  UserTrait,
  AgentTrait,
  ExternalcontactTrait,
  MediaTrait,
  KfTrait,
  DepartmentTrait,
  TagTrait;

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
    $errText = ErrorCode::getError($this->getErrcode());

    if ($errText) {
      $this->errmsg = $errText;
    }
  }

  /**
   * 防止克隆
   */
  private function __clone(){}
}