<?php
namespace Fushengfu\Wechat;

trait Component {
  /**
   * 启动票据推送服务
   */
  public function apiStartPushTicket()
  {
    $this->httpPost('/cgi-bin/component/api_start_push_ticket', json_encode([
      "component_appid"=> $this->componentAppid,
      "component_secret"=> $this->componentSecret
    ]));

    return $this->getResponse();
  }

  /**
   * 拉取已授权的帐号信息
   */
  public function getAuthorizerList(int $offset = 0, $count = 500)
  {
    $this->httpPost("/cgi-bin/component/api_get_authorizer_list?access_token={$this->getComponentAccessToken()}", json_encode([
      "component_appid"=> $this->componentAppid,
      "offset"=> $offset,
      "count"=> $count
    ]));

    return $this->getResponse();
  }

  /**
   * 拉取已授权的帐号信息
   */
  public function getAuthorizerInfo()
  {
    $this->httpPost("/cgi-bin/component/api_get_authorizer_info?access_token={$this->getComponentAccessToken()}", json_encode([
      "component_appid"=> $this->componentAppid,
      "authorizer_appid"=> $this->appid
    ]));

    return $this->getResponse();
  }

  /**
   * 获取授权方选项信息
   */
  public function getAuthorizerOption($optionName)
  {
    $this->httpPost("/cgi-bin/component/api_get_authorizer_option?access_token={$this->getComponentAccessToken()}", json_encode([
      "component_appid"=> $this->componentAppid,
      "authorizer_appid"=> $this->appid,
      "option_name"=> $optionName
    ]));

    return $this->getResponse();
  }

  /**
   * 设置授权方选项信息
   */
  public function setAuthorizerOption(array $data)
  {
    $this->httpPost("/cgi-bin/component/api_set_authorizer_option?access_token={$this->getComponentAccessToken()}", json_encode([
      "component_appid"=> $this->componentAppid,
      "authorizer_appid"=> $this->appid,
      "option_name"=> $data['option_name'],
      "option_value"=> $data['option_value']
    ]));

    return $this->getResponse();
  }

  /**
   * 设置授权方选项信息
   */
  public function modifyWxaServerDomain(array $data)
  {
    $uri = "/cgi-bin/component/modify_wxa_server_domain?access_token={$this->getComponentAccessToken()}";
    $this->httpPost($uri, json_encode($data));

    return $this->getResponse();
  }

  /**
   * 获取第三方平台业务域名校验文件
   */
  public function getDomainConfirmfile()
  {
    $this->httpPost("/cgi-bin/component/get_domain_confirmfile?access_token={$this->getComponentAccessToken()}");

    return $this->getResponse();
  }

  /**
   * 设置第三方平台业务域名
   */
  public function modifyWxaJumpDomain(array $data)
  {
    $this->httpPost("/cgi-bin/component/modify_wxa_jump_domain?access_token={$this->getComponentAccessToken()}", json_encode($data));

    return $this->getResponse();
  }

  /**
   * 获取开放平台帐号
   */
  public function getOpenAccount()
  {
    $this->httpPost("/cgi-bin/open/get?access_token={$this->getAccessToken()}", json_encode([
      'appid'=> $this->appid
    ]));

    return $this->getResponse();
  }

  /**
   * 创建开放平台帐号
   */
  public function createOpenAccount()
  {
    $this->httpPost("/cgi-bin/open/create?access_token={$this->getAccessToken()}", json_encode([
      'appid'=> $this->appid
    ]));

    return $this->getResponse();
  }

  /**
   * 创建开放平台帐号
   */
  public function registerMiniprogram(array $data)
  {
    $this->httpPost("/cgi-bin/component/fastregisterweapp?action=create&component_access_token={$this->getComponentAccessToken()}", 
      json_encode($data)
    );

    return $this->getResponse();
  }

  /**
   * 复用公众号主体快速注册小程序
   */
  public function registerMiniprogramByOffiaccount(string $ticket)
  {
    $this->httpPost("/cgi-bin/account/fastregister?access_token={$this->getAccessToken()}", 
      json_encode([
        'ticket'=> $ticket
      ])
    );

    return $this->getResponse();
  }

  /**
   * 小程序登录
   */
  public function thirdpartyCode2Session(string $code)
  {
    $this->httpGet("/sns/component/jscode2session?appid={$this->appid}&js_code={$code}&grant_type=authorization_code&component_appid={$this->componentAppid}&component_access_token={$this->getComponentAccessToken()}");

    return $this->getResponse();
  }

  /**
   * 获取基本信息
   */
  public function getAccountBasicInfo()
  {
    $this->httpGet("/cgi-bin/account/getaccountbasicinfo?access_token={$this->getAccessToken()}");

    return $this->getResponse();
  }
}