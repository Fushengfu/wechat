<?php

trait User {
  /**
   * 创建成员
   */
  public function userCreate(array $data)
  {
    $uri = "/cgi-bin/user/create?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 读取成员
   */
  public function userGet(string $userid)
  {
    $uri = "/cgi-bin/user/get?access_token={$this->getAccessToken()}&userid={$userid}";
    $this->httpGet($uri);
    return $this->http->getResponse();
  }
}