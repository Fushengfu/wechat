<?php

namespace Fushengfu\Wechat\officialAccount\traits;

trait ComponentTrait {

  /**
   * 网页授权
   */
  public function oauth(string $redirectUri)
  {
    if ($_GET['code']) {
      $this->getAccessToken($_GET['code']);
    } else {
      /**
       * 第三方平台授权
       */
      $uri = "/connect/oauth2/authorize?appid={$this->appid}&redirect_uri={urlencode($redirectUri)}&response_type=code&scope=snsapi_userinfo&state=STATE&component_appid={$this->componentAppid}#wechat_redirect";

      /**
       * 企业内部授权
       */
      if ($this->componentAppid == null) {
        $uri = "/connect/oauth2/authorize?appid={$this->appid}&redirect_uri={urlencode($redirectUri)}&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
      }
      
      header("Location: https://open.weixin.qq.com".$uri);
      exit;
    }
  }

  /**
   * 获取component_access_token
   */
  public function getComponentAccessToken()
  {
    $response = $this->cache->get('component_access_token');
    if (!$response) {
      $this->httpPost('/cgi-bin/component/api_component_token', json_encode([
        'component_appid'=> $this->componentAppid,
        'component_appsecret'=> $this->componentAppsecret,
        'component_verify_ticket'=> $this->componentVerifyTicket,
      ]));
  
      if ($this->Ok()) {
        $response = $this->toArray();
        $this->cache->set('component_access_token', $this->toJson(), (int)$response['expires_in'] - 60);
      }
    } else {
      $response = json_decode($response, true);
    }

    // {
    //   "component_access_token": "61W3mEpU66027wgNZ_MhGHNQDHnFATkDa9-2llqrMBjUwxRSNPbVsMmyD-yq8wZETSoE5NQgecigDrSHkPtIYA",
    //   "expires_in": 7200
    // }
    return $response['component_access_token'];
  }

  /**
   * 获取预授权码
   */
  public function getPreAuthCode()
  {
    $this->httpGet('/cgi-bin/component/api_create_preauthcode?component_access_token='.$this->getComponentAccessToken());

    // {
    //   "pre_auth_code": "Cx_Dk6qiBE0Dmx4EmlT3oRfArPvwSQ-oa3NL_fwHM7VI08r52wazoZX2Rhpz1dEw",
    //   "expires_in": 600
    // }
    return $this->getResponse();
  }

  /**
   * 使用授权码获取授权信息
   */
  public function apiQueryAuth(string $authorizationCode)
  {
    $uri = "/cgi-bin/component/api_query_auth?component_access_token={$this->getComponentAccessToken()}";
    $response = $this->httpPost($uri, json_encode([
      "component_appid"=> $this->componentAppid,
      "authorization_code"=>  $authorizationCode
    ]));

    if ($this->Ok()) {
      $response = $this->toArray();
      $authorizationInfo = $response['authorization_info'];
      $this->appid = $authorizationInfo['authorizer_appid'];
      $authorizationInfo['access_token'] = $authorizationInfo['authorizer_access_token'];
      $authorizationInfo['refresh_token'] = $authorizationInfo['authorizer_refresh_token'];
      $this->cache->set($this->appid.'_access_token', json_encode($authorizationInfo), (int)$authorizationInfo['expires_in'] - 60);
      $this->cache->set($this->appid.'_refresh_token', $authorizationInfo['authorizer_refresh_token'], 0);
    }

    return $response;
  }

  /**
   * 获取access_token
   */
  public function getAccessToken($code = null): string
  {
    if ($code) {
      $this->cli = false;
    }

    $this->authorizerRefreshToken = $this->cache->get($this->appid.'_refresh_token');
    $response = $this->cache->get($this->appid.'_access_token');

    if (!$response || $code) {

      /**
       * 第三方平台调用
       */
      if ($this->componentAppid != null) {
        if ($code) {
          $uri = "/sns/oauth2/component/access_token?appid={$this->appid}&code={$code}&grant_type=authorization_code&component_appid={$this->componentAppid}&component_access_token=".$this->getComponentAccessToken();
        } else {
          $response = $this->apiAuthorizerToken();
        }
      } else {

        /**
         * 企业内部调用
         */
        if ($code) {
          $uri = "/sns/oauth2/access_token?appid={$this->appid}&secret={$this->secret}&code={$code}&grant_type=authorization_code";
        } else {
          $uri = "/cgi-bin/token?grant_type=client_credential&appid={$this->appid}&secret={$this->secret}";
        }
      }

      if ($uri) {
        $this->httpGet($uri);
    
        if ($this->Ok()) {
          $response = $this->toArray();
          if ($this->cli) {
            $this->cache->set($this->appid.'_access_token', $this->toJson(), (int)$response['expires_in'] - 60);
          } else {
            $this->cache->set($this->appid.$response['openid'].'_access_token', $this->toJson(), (int)$response['expires_in'] - 60);
          }
        }
      }
    } else {
      $response = json_decode($response, true);
    }

    $this->accessToken = $response['access_token'];

    return $response['access_token'];
  }

  /**
   * 刷新access_token|authorizer_refresh_token
   */
  public function apiAuthorizerToken()
  {
    $uri = "/cgi-bin/component/api_authorizer_token?component_access_token={$this->getComponentAccessToken()}";
    $response = $this->httpPost($uri, json_encode([
      "component_appid"=> $this->componentAppid,
      "authorizer_appid"=> $this->appid,
      "authorizer_refresh_token"=> $this->authorizerRefreshToken
    ]));

    if ($this->Ok()) {
      $response = $this->toArray();
      $response['access_token'] = $response["authorizer_access_token"];
      $response['refresh_token'] = $response["authorizer_refresh_token"];
      $this->cache->set($this->appid.'_access_token', $this->toJson(), (int)$response['expires_in'] - 60);
      $this->cache->set($this->appid.'_refresh_token', $response['authorizer_refresh_token'], 0);
    }

    return $response;
  }

  /**
   * refresh_token
   */
  public function refreshAccessToken(string $refreshToken): string
  {
    if ($this->componentAppid != null) {
      $uri = "/sns/oauth2/component/refresh_token?appid={$this->appid}&grant_type=refresh_token&component_appid={$this->componentAppid}&component_access_token={$this->getComponentAccessToken()}&refresh_token={$refreshToken}";
    } else {
      $uri = "/sns/oauth2/refresh_token?appid={$this->appid}&grant_type=refresh_token&refresh_token={$refreshToken}";
    }
    
    $this->httpGet($uri);

    if ($this->Ok()) {
      $response = $this->toArray();
      $this->cache->set($this->appid.$response['openid'].'_access_token', $this->toJson(), (int)$response['expires_in'] - 60);
      $this->cache->set($this->appid.$response['openid'].'_refresh_token', $response['refresh_token'], 0);
    }

    // {
    //   "access_token": "ACCESS_TOKEN",
    //   "expires_in": 7200,
    //   "refresh_token": "REFRESH_TOKEN",
    //   "openid": "OPENID",
    //   "scope": "SCOPE"
    // }
    return $response;
  }

  /**
   * 获取用户信息 通过网页授权 access_token 获取用户基本信息
   */
  public function getUserInfo(string $openid, string $lang = 'zh_CN')
  {
    $uri = "/cgi-bin/user/info?access_token={$this->getAccessToken()}&openid={$openid}&lang={$lang}";
    if (!$this->cli) {
      $uri = "/sns/userinfo?access_token={$this->accessToken}&openid={$openid}&lang={$lang}";
    }
    $this->httpGet($uri);

    // {
    //   "openid": " OPENID",
    //   "nickname": "NICKNAME",
    //   "sex": "1",
    //   "province": "PROVINCE",
    //   "city": "CITY",
    //   "country": "COUNTRY",
    //   "headimgurl": "http://wx.qlogo.cn/mmopen/g3MonUZtNHkdmzicIlibx6iaFqAc56vxLSUfpb6n5WKSYVY0ChQKkiaJSgQ1dZuTOgvLLrhJbERQQ4eMsv84eavHiaiceqxibJxCfHe/46",
    //   "privilege": ["PRIVILEGE1", "PRIVILEGE2"],
    //   "unionid": "o6_bmasdasdsad6_2sgVt7hMZOPfL"
    // }

    return $this->getResponse();
  }

  /**
   * 获取用户列表
   */
  public function getOpenidList(string $openid = '')
  {
    $uri = "/cgi-bin/user/get?access_token={$this->getAccessToken()}&next_openid={$openid}";
    $this->httpGet($uri);

    return $this->getResponse();
  }

  /**
   * 永久二维码
   */
  public function qrcodeCreate(array $data)
  {
    $uri = "/cgi-bin/qrcode/create?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));

    return $this->getResponse();
  }

  /**
   * 检验授权凭证（access_token）是否有效
   */
  public function checkAccessToken(string $openid)
  {
    $uri = "/sns/auth?access_token={$this->getAccessToken()}&openid={$openid}";
    $this->httpGet($uri);

    return $this->getResponse();
  }

  /**
   * 获取服务器IP
   */
  public function getApiDomainIp()
  {
    $uri = "/cgi-bin/get_api_domain_ip?access_token={$this->getAccessToken()}";
    $this->httpGet($uri);

    return $this->getResponse();
  }
}