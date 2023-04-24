<?php

namespace Fushengfu\Wechat\officialAccount\traits;

trait CustomserviceTrait {
  /**
   * 添加客服帐号
   */
  public function kfaccountAdd(array $data)
  {
    $this->httpPost('/customservice/kfaccount/add?access_token='.$this->getAccessToken(), json_encode($data));
    return $this->getResponse();
  }

  /**
   * 修改客服帐号
   */
  public function kfaccountUpdate(array $data)
  {
    $this->httpPost('/customservice/kfaccount/update?access_token='.$this->getAccessToken(), json_encode($data));
    return $this->getResponse();
  }

  /**
   * 删除客服帐号
   */
  public function kfaccountDelete(array $data)
  {
    $this->httpPost('/customservice/kfaccount/del?access_token='.$this->getAccessToken(), json_encode($data));
    return $this->getResponse();
  }

  /**
   * 设置客服帐号的头像
   */
  public function kfaccountUploadheadimg(string $kfAccount, array $data)
  {
    $this->httpPost("/customservice/kfaccount/uploadheadimg?access_token={$this->getAccessToken()}&kf_account={$kfAccount}", $data);
    return $this->getResponse();
  }

  /**
   * 获取所有客服账号
   */
  public function getkflist()
  {
    $this->httpGet("/cgi-bin/customservice/getkflist?access_token={$this->getAccessToken()}");
    return $this->getResponse();
  }

  /**
   * 客服接口 - 发消息
   */
  public function messageCustomSend(array $data)
  {
    $this->httpPost("/cgi-bin/message/custom/send?access_token={$this->getAccessToken()}", json_encode($data));
    return $this->getResponse();
  }

  /**
   * 客服输入状态
   */
  public function messageCustomTyping(array $data)
  {
    $this->httpPost("/cgi-bin/message/custom/typing?access_token={$this->getAccessToken()}", json_encode($data));
    return $this->getResponse();
  }

  /**
   * 创建会话
   */
  public function kfsessionCreate(array $data)
  {
    $this->httpPost("/customservice/kfsession/create?access_token={$this->getAccessToken()}", json_encode($data));
    return $this->getResponse();
  }

  /**
   * 关闭会话
   */
  public function kfsessionClose(array $data)
  {
    $this->httpPost("/customservice/kfsession/close?access_token={$this->getAccessToken()}", json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取客户会话状态
   */
  public function kfsessionGetsession(string $openid)
  {
    $this->httpGet("/customservice/kfsession/getsession?access_token={$this->getAccessToken()}&openid={$openid}");
    return $this->getResponse();
  }

  /**
   * 获取客服会话列表
   */
  public function kfsessionGetsessionlist(string $kfAccount)
  {
    $this->httpGet("/customservice/kfsession/getsessionlist?access_token={$this->getAccessToken()}&kf_account={$kfAccount}");
    return $this->getResponse();
  }

  /**
   * 获取未接入会话列表
   */
  public function getwaitcase()
  {
    $this->httpGet("/customservice/kfsession/getwaitcase?access_token={$this->getAccessToken()}");
    return $this->getResponse();
  }

  /**
   * 获取聊天记录
   */
  public function getmsglist(array $data)
  {
    $this->httpPost("/customservice/msgrecord/getmsglist?access_token={$this->getAccessToken()}", json_encode($data));
    return $this->getResponse();
  }
}