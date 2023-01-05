<?php

namespace Fushengfu\Wechat\work\traits;

trait Service {
  public function getPreAuthCode()
  {
    $this->httpGet($this->baseUrl.'/cgi-bin/service/get_pre_auth_code?suite_access_token='.$this->getAccessToken());
    var_dump($this->http->getRequestHeaders());
    return $this->http->getResponse();
  }
}