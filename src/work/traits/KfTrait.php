<?php
namespace Fushengfu\Wechat\work\traits;

trait KfTrait {

  /**
   * 添加客服帐号
   */
  public function kfAccountAdd(array $data)
  {
    $uri = "/cgi-bin/kf/account/add?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 删除客服帐号
   */
  public function kfAccountDel(string $openKfid)
  {
    $uri = "/cgi-bin/kf/account/del?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode([
      'open_kfid'=> $openKfid
    ]));
    return $this->getResponse();
  }

  /**
   * 修改客服帐号
   */
  public function kfAccountUpdate(array $data)
  {
    $uri = "/cgi-bin/kf/account/update?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode(array_filter($data)));
    return $this->getResponse();
  }

  /**
   * 获取客服帐号列表
   */
  public function kfAccountList(array $data)
  {
    $uri = "/cgi-bin/kf/account/list?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, $data);
    return $this->getResponse();
  }

  /**
   * 获取客服帐号链接
   */
  public function kfAddContactWay(array $data)
  {
    $uri = "/cgi-bin/kf/add_contact_way?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 添加接待人员
   */
  public function kfServicerAdd(array $data)
  {
    $uri = "/cgi-bin/kf/servicer/add?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 删除接待人员
   */
  public function kfServicerDel(array $data)
  {
    $uri = "/cgi-bin/kf/servicer/del?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取接待人员列表
   */
  public function kfServicerList()
  {
    $uri = "/cgi-bin/kf/servicer/list?access_token={$this->getAccessToken()}";
    $this->httpGet($uri);
    return $this->getResponse();
  }

  /**
   * 获取会话状态
   */
  public function kfServiceStateGet(array $data)
  {
    $uri = "/cgi-bin/kf/service_state/get?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data, JSON_UNESCAPED_UNICODE));
    return $this->getResponse();
  }

  /**
   * 变更会话状态
   */
  public function kfServiceStateTrans(array $data)
  {
    $uri = "/cgi-bin/kf/service_state/trans?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data, JSON_UNESCAPED_UNICODE));
    return $this->getResponse();
  }

  /**
   * 发送消息
   */
  public function kfSendMsg(array $data)
  {
    $uri = "/cgi-bin/kf/send_msg?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取客户基础信息
   */
  public function kfCustomerBatchget(array $data)
  {
    $uri = "/cgi-bin/kf/customer/batchget?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取视频号绑定状态
   */
  public function getCorpQualification()
  {
    $uri = "/cgi-bin/kf/get_corp_qualification?access_token={$this->getAccessToken()}";
    $this->httpGet($uri);
    return $this->getResponse();
  }

  /**
   * 获取「客户数据统计」企业汇总数据
   */
  public function getCorpStatistic(array $data)
  {
    $uri = "/cgi-bin/kf/get_corp_statistic?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取「客户数据统计」接待人员明细数据
   */
  public function getServicerStatistic(array $data)
  {
    $uri = "/cgi-bin/kf/get_servicer_statistic?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }
}