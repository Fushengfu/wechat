<?php

namespace Fushengfu\Wechat\officialAccount;

use Fushengfu\Wechat\Wechat;
use Fushengfu\Wechat\officialAccount\traits\{
  ComponentTrait,
  MenuTrait
};


class Application extends Wechat {
  /**
   * 企业配置
   */
  protected $appid;

	protected $secret;

  protected $componentAppid;

  protected $componentAppsecret;

  protected $authorizerRefreshToken;

	protected $accessToken;

  protected $authorizerAccessToken;

  protected $componentVerifyTicket;

  protected $componentAccessToken;

  use ComponentTrait,MenuTrait;

  /**
   * 构造函数
   */
  public function __construct(array $config)
  {
    $this->initConfig($config);
  }

  /**
   * 防止克隆
   */
  private function __clone(){}
}