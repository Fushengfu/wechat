<?php
namespace Fushengfu\Wechat\officialAccount;

use Fushengfu\Wechat\{
  Wechat,
  Component
};
use Fushengfu\Wechat\officialAccount\traits\{
  ComponentTrait,
  MenuTrait,
  MediaTrait,
  CustomserviceTrait,
  TemplateTrait
};


class Application extends Wechat {
  /**
   * 企业配置
   */
  protected $appid;

	protected $secret;

	protected $accessToken;

  /**
   * 第三方平台
   */
  protected $componentAppid;

  protected $componentAppsecret;

  protected $authorizerRefreshToken;

  protected $authorizerAccessToken;

  protected $componentVerifyTicket;

  protected $componentAccessToken;

  use ComponentTrait,MenuTrait,MediaTrait,CustomserviceTrait,TemplateTrait;

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
   * 防止克隆
   */
  private function __clone(){}
}