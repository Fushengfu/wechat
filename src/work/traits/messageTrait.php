<?php
trait MessageTrait {
  /**
   * 发送应用消息
   */
  public function messageSend(array $data)
  {
    $uri = "/cgi-bin/message/send?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 更新模版卡片消息
   */
  public function updateTemplateCard(array $data)
  {
    $uri = "/cgi-bin/message/update_template_card?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 撤回应用消息
   */
  public function recall(array $data)
  {
    $uri = "/cgi-bin/message/recall?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }
}