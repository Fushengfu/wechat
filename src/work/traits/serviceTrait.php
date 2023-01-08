<?php

namespace Fushengfu\Wechat\work\traits;

trait ServiceTrait {
  /**
   * 获取access_token
   */
  public function getAccessToken(): string
  {
    $cacheKey = $this->suiteId.'access_token';
    $response = $this->cache->get($cacheKey);

    if (!$response) {

      if ($this->suiteId) {
        /**
         * 第三方调用
         */
        $this->httpPost("/cgi-bin/service/get_corp_token?suite_access_token={$this->getSuiteAccessToken()}", 
          json_encode([
            "auth_corpid"=> $this->appid,
            "permanent_code"=> $this->permanentCode
          ])
        );
      } else {

        /**
         * 企业内部调用
         */
        $this->httpGet("/cgi-bin/gettoken?corpid={$this->appid}&corpsecret={$this->secret}");
      }

      if ($this->getStatusCode() == 200 && $this->successCode() == $this->getErrcode()) {
        $response = $this->toArray();
        $this->cache->set($cacheKey, $this->toJson(), (int)$response['expires_in'] - 60);
      }
    } else {
      $response = json_decode($response, true);
    }

    return $response['access_token'];
  }

  /**
   * 获取suite_access_token
   */
  public function getSuiteAccessToken(): string
  {
    $response = $this->cache->get('suite_access_token');
    if (!$response) {
      $this->httpPost('/cgi-bin/service/get_suite_token', json_encode([
        "suite_id"=> $this->suiteId,
        "suite_secret"=> $this->suiteSecret,
        "suite_ticket"=> $this->suiteTicket
      ]));

      if ($this->getStatusCode() == 200 && $this->successCode() == $this->getErrcode()) {
        $response = $this->toArray();
        $this->cache->set('suite_access_token', $this->toJson(), (int)$response['expires_in'] - 60);
      }
    } else {
      $response = json_decode($response, true);
    }

    return $response['suite_access_token'];
  }

  /**
   * 获取服务商凭证
   */
  public function getProviderToken()
  {
    $response = $this->cache->get('provider_access_token');

    if (!$response) {
      $this->httpPost('/cgi-bin/service/get_provider_token', json_encode([
        "corpid"=> $this->corpid,
        "provider_secret"=> $this->providerSecret
      ]));
  
      if ($this->getStatusCode() == 200 && $this->successCode() == $this->getErrcode()) {
        $response = $this->toArray();
        $this->cache->set('provider_access_token', $this->toJson(), (int)$response['expires_in'] - 60);
      }
    } else {
      $response = json_decode($response, true);
    }

    return $response['provider_access_token'];
  }

  /**
   * 设置suiteAccessToken
   */
  public function setSuiteAccessToken(string $suiteAccessToken)
  {
    $this->suiteAccessToken = $suiteAccessToken;
  }

  /**
   * 获取预授权码
   */
  public function getPreAuthCode()
  {
    $this->httpGet('/cgi-bin/service/get_pre_auth_code?suite_access_token='.$this->getSuiteAccessToken());
    return $this->getResponse();
  }

  /**
   * 获取企业微信服务器的ip段
   */
  public function getcallbackip()
  {
    $this->httpGet('/cgi-bin/getcallbackip?access_token='.$this->getAccessToken());
    return $this->getResponse();
  }

  /**
   * 企业明文corpid 转 密文opencorpid
   */
  public function corpidToOpencorpid()
  {
    $uri = '/cgi-bin/service/corpid_to_opencorpid?provider_access_token='.$this->getProviderToken();
    $this->httpPost($uri, json_encode([
      'corpid'=> $this->appid
    ]));
    return $this->getResponse();
  }

  /**
   * userid的转换
   */
  public function useridToOpenuserid(array $data)
  {
    $uri = "/cgi-bin/batch/userid_to_openuserid?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode([
      'userid_list'=> $data
    ]));
    return $this->getResponse();
  }

  /**
   * 转换external_userid
   */
  public function getNewExternalUserid(array $data)
  {
    $uri = "/cgi-bin/externalcontact/get_new_external_userid?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode([
      'external_userid_list'=> $data
    ]));
    return $this->getResponse();
  }

  /**
   * 转换客户群成员external_userid
   */
  public function groupchatGetNewExternalUserid(string $chatId, array $data)
  {
    $this->httpPost('/cgi-bin/externalcontact/groupchat/get_new_external_userid?access_token='.$this->getAccessToken(),
    json_encode([
      'chat_id'=> $chatId,
      'external_userid_list'=> $data
    ]));
    return $this->getResponse();
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
    return $this->getResponse();
  }

  /**
   * 获取访问用户敏感信息
   */
  public function getuserdetail3rd(array $data)
  {
    $uri = "/cgi-bin/service/auth/getuserdetail3rd?suite_access_token={$this->getSuiteAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
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
    return $this->getResponse();
  }

  /**
   * 获取企业授权信息
   */
  public function getAuthInfo()
  {
    $uri = "/cgi-bin/service/get_auth_info?suite_access_token={$this->getSuiteAccessToken()}";
    $this->httpPost($uri, json_encode([
      "auth_corpid"=> $this->appid,
 	    "permanent_code"=> $this->permanentCode
    ]));
    return $this->getResponse();
  }

  /**
   * 通讯录单个搜索
   */
  public function contactSearch(array $data)
  {
    $data["auth_corpid"] = $this->appid;
    $uri = "/cgi-bin/service/contact/search?provider_access_token={$this->getProviderToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 通讯录批量搜索
   */
  public function contactBatchSearch(array $data)
  {
    $data["auth_corpid"] = $this->appid;
    $uri = "/cgi-bin/service/contact/batchsearch?provider_access_token={$this->getProviderToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 上传需要转译的文件
   */
  public function serviceMediaUpload(array $data)
  {
    $uri = "/cgi-bin/service/media/upload?provider_access_token={$this->getProviderToken()}&type={$data['type']}";
    $this->httpPost($uri, $data);
    return $this->getResponse();
  }

  /**
   * 通讯录id替换
   */
  public function contactIdTranslate(array $data)
  {
    $data["auth_corpid"] = $this->appid;
    $uri = "/cgi-bin/service/contact/id_translate?provider_access_token={$this->getProviderToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取异步任务结果
   */
  public function batchGetResult(string $jobid)
  {
    $uri = "/cgi-bin/service/batch/getresult?provider_access_token={$this->getProviderToken()}&jobid={$jobid}";
    $this->httpGet($uri);
    return $this->getResponse();
  }

  /**
   * 通讯录userid排序
   */
  public function contactSort(array $data)
  {
    $data["auth_corpid"] = $this->appid;
    $uri = "/cgi-bin/service/contact/sort?provider_access_token={$this->getProviderToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取企业的jsapi_ticket
   */
  public function getJsapiTicket(): string
  {
    $cacheKey = $this->suiteId.'_jsapi_ticket';
    $response = $this->cache->get($cacheKey);

    if (!$response) {
      $uri = "/cgi-bin/get_jsapi_ticket?access_token={$this->getSuiteAccessToken()}";
      $this->httpGet($uri);

      if ($this->getStatusCode() == 200 && $this->successCode() == $this->getErrcode()) {
        $response = $this->toArray();
        $this->cache->set($cacheKey, $this->toJson(), (int)$response['expires_in'] - 60);
      }
    } else {
      $response = json_decode($response, true);
    }
    
    return $response['ticket']??'';
  }

  /**
   * 获取应用的jsapi_ticket
   */
  public function getAgentJsapiTicket(): string
  {
    $response = $this->cache->get($this->suiteId.'agent_jsapi_ticket');

    if (!$response) {
      $uri = "/cgi-bin/ticket/get?access_token={$this->getSuiteAccessToken()}&type=agent_config";
      $this->httpGet($uri);

      if ($this->getStatusCode() == 200 && $this->successCode() == $this->getErrcode()) {
        $response = $this->toArray();
        $this->cache->set($this->suiteId.'agent_jsapi_ticket', $this->toJson(), (int)$response['expires_in'] - 60);
      }
    } else {
      $response = json_decode($response, true);
    }
  
    return $response['ticket']??'';
  }
}