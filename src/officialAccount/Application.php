<?php

namespace Fushengfu\Wechat\officialAccount;

use Fushengfu\Wechat\Wechat;
use Fushengfu\Wechat\officialAccount\traits\{
  Component,
  Menu
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

  use Component,Menu;

  /**
   * 构造函数
   */
  public function __construct(array $config)
  {
    $this->initConfig($config);
  }

  /**
   * 网页授权
   */
  public function oauth(string $redirectUri)
  {
    $uri = "/connect/oauth2/authorize?appid={$this->appid}&redirect_uri={urlencode($redirectUri)}&response_type=code&scope=snsapi_userinfo&state=STATE&component_appid={$this->componentAppid}#wechat_redirect";
    if ($this->componentAppid == null) {
      $uri = "/connect/oauth2/authorize?appid={$this->appid}&redirect_uri={urlencode($redirectUri)}&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
    }
    
    header("Location: https://open.weixin.qq.com".$uri);
    exit;
  }

  /**
   * 获取access_token
   */
  public function getAccessToken($type = 'cli', $code = null): string
  {
    if ($type == 'cli') {
      $uri = "/cgi-bin/token?grant_type=client_credential&appid={$this->appid}&secret={$this->secret}";
    } else {
      $uri = "/sns/oauth2/access_token?appid={$this->appid}&secret={$this->secret}&code={$code}&grant_type=authorization_code";
      if ($this->componentAppid != null) {
        $uri = "/sns/oauth2/component/access_token?appid={$this->appid}&code={$code}&grant_type=authorization_code&component_appid={$this->componentAppid}&component_access_token=".$this->getComponentAccessToken();
      }
    }

    $this->httpGet($uri);

    return $this->http->getResponse();
  }

  /**
   * refresh_token
   */
  public function refreshAccessToken(string $refreshToken)
  {
    $uri = "/sns/oauth2/refresh_token?appid={$this->appid}&grant_type=refresh_token&refresh_token={$refreshToken}";
    $this->httpGet($uri);

    return $this->http->getResponse();
  }

  /**
   * 获取用户信息 通过网页授权 access_token 获取用户基本信息
   */
  public function getUserInfo(string $openid, string $type = 'cli', string $lang = 'zh_CN')
  {
    $uri = "/cgi-bin/user/info?access_token={$this->getAccessToken()}&openid={$openid}&lang={$lang}";
    if ($type != 'cli') {
      $uri = "/sns/userinfo?access_token={$this->getAccessToken()}&openid={$openid}&lang={$lang}";
    }
    $this->httpGet($uri);

    return $this->http->getResponse();
  }

  /**
   * 获取用户列表
   */
  public function getOpenidList(string $openid)
  {
    $uri = "/cgi-bin/user/get?access_token={$this->getAccessToken()}&next_openid={$openid}";
    $this->httpGet($uri);

    return $this->http->getResponse();
  }

  /**
   * 永久二维码
   */
  public function qrcodeCreate(array $data)
  {
    $uri = "/cgi-bin/qrcode/create?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));

    return $this->http->getResponse();
  }

  /**
   * 检验授权凭证（access_token）是否有效
   */
  public function checkAccessToken(string $openid)
  {
    $uri = "/sns/auth?access_token={$this->getAccessToken()}&openid={$openid}";
    $this->httpGet($uri);

    return $this->http->getResponse();
  }

  /**
   * 获取服务器IP
   */
  public function getApiDomainIp()
  {
    $uri = "/sns/userinfo?access_token=".$this->accessToken;
    $this->httpGet($uri);

    return $this->http->getResponse();
  }

  /**
   * 防止克隆
   */
  private function __clone(){}
}