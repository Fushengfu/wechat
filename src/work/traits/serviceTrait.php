<?php

namespace Fushengfu\Wechat\work\traits;

trait ServiceTrait {
  public function getPreAuthCode()
  {
    $this->httpGet('/cgi-bin/service/get_pre_auth_code?suite_access_token='.$this->getAccessToken());
    return $this->http->getResponse();
  }

  /**
   * 获取服务商凭证
   */
  public function getProviderToken()
  {
    $this->httpPost('/cgi-bin/service/get_provider_token', json_encode([
      "corpid"=> "xxxxx",
      "provider_secret"=> "xxx"
    ]));
    return $this->http->getResponse();
  }

  /**
   * 获取企业微信服务器的ip段
   */
  public function getcallbackip()
  {
    $this->httpGet('/cgi-bin/getcallbackip?access_token='.$this->getAccessToken());
    return $this->http->getResponse();
  }

  /**
   * 获取企业微信服务器的ip段
   */
  public function corpidToOpencorpid()
  {
    $this->httpGet('/cgi-bin/service/corpid_to_opencorpid?provider_access_token='.$this->getProviderToken());
    return $this->http->getResponse();
  }

  /**
   * userid的转换
   */
  public function useridToOpenuserid(array $data)
  {
    $this->httpPost('/cgi-bin/batch/userid_to_openuserid?access_token='.$this->getAccessToken(), json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 转换external_userid
   */
  public function getNewExternalUserid(array $data)
  {
    $this->httpPost('/cgi-bin/externalcontact/get_new_external_userid?access_token='.$this->getAccessToken(), json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 转换客户群成员external_userid
   */
  public function groupchatGetNewExternalUserid(array $data)
  {
    $this->httpPost('/cgi-bin/externalcontact/groupchat/get_new_external_userid?access_token='.$this->getAccessToken(), json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 构造网页授权链接
   */
  public function oauth2(string $redirectUri, $scope = 'snsapi_privateinfo', $state = 'STATE')
  {
    $uri = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->appid}&redirect_uri={urlencode($redirectUri)}&response_type=code&scope={$scope}&state={$state}#wechat_redirect";
    return $uri;
  }

  /**
   * 获取访问用户身份
   */
  public function getuserinfo3rd(string $code)
  {
    $uri = "/cgi-bin/service/auth/getuserinfo3rd?suite_access_token={$this->getSuiteAccessToken()}&code={$code}";
    $this->httpGet($uri);
    return $this->http->getResponse();
  }

  /**
   * 获取访问用户敏感信息
   */
  public function getuserdetail3rd(array $data)
  {
    $uri = "/cgi-bin/service/auth/getuserdetail3rd?suite_access_token={$this->getSuiteAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取登录用户信息
   */
  public function getLoginInfo(string $authCode)
  {
    $uri = "/cgi-bin/service/get_login_info?access_token={$this->getProviderToken()}";
    $this->httpPost($uri, json_encode([
      'auth_code'=> $authCode
    ]));
    return $this->http->getResponse();
  }
}