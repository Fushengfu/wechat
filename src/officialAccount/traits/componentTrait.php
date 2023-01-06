<?php

namespace Fushengfu\Wechat\officialAccount\traits;

trait ComponentTrait {

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
  
      if ($this->http->getStatusCode() == 200 && !isset($response['errcode'])) {
        $response = $this->http->toArray();
        $this->cache->set('component_access_token', $this->http->toJson(), (int)$response['expires_in'] - 60);
        $response = $this->http->toJson();
      }
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
    return $this->http->getResponse();
  }

  /**
   * 获取授权信息
   */
  public function getAuthInfo(string $authorizationCode)
  {
    $this->httpPost('/cgi-bin/component/api_query_auth?component_access_token='.$this->getComponentAccessToken(), json_encode([
      'component_appid'=> $this->componentAppid,
      'authorization_code'=> $authorizationCode,
    ]));

    // {
    //   "authorization_info": {
    //     "authorizer_appid": "wxf8b4f85f3a794e77",
    //     "authorizer_access_token": "QXjUqNqfYVH0yBE1iI_7vuN_9gQbpjfK7hYwJ3P7xOa88a89-Aga5x1NMYJyB8G2yKt1KCl0nPC3W9GJzw0Zzq_dBxc8pxIGUNi_bFes0qM",
    //     "expires_in": 7200,
    //     "authorizer_refresh_token": "dTo-YCXPL4llX-u1W1pPpnp8Hgm4wpJtlR6iV0doKdY",
    //     "func_info": [
    //       {
    //         "funcscope_category": {
    //           "id": 1
    //         }
    //       },
    //       {
    //         "funcscope_category": {
    //           "id": 2
    //         }
    //       },
    //       {
    //         "funcscope_category": {
    //           "id": 3
    //         }
    //       }
    //     ]
    //   }
    // }    
    return $this->http->getResponse();
  }

  /**
   * 刷新access_tokenauthorizer_refresh_token
   */
  public function refreshAuthorizerToken(string $authorizerRefreshToken)
  {
    $this->http->post('/cgi-bin/component/api_authorizer_token?component_access_token='.$this->getComponentAccessToken(), json_encode([
      "component_appid"=> $this->componentAppid,
      "authorizer_appid"=> $this->authorizerAppid,
      "authorizer_refresh_token"=> $authorizerRefreshToken
    ]));

    // {
    //   "authorizer_access_token": "some-access-token",
    //   "expires_in": 7200,
    //   "authorizer_refresh_token": "refresh_token_value"
    // }
    return $this->http->getResponse();
  }
}