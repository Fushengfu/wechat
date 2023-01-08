<?php
namespace Fushengfu\Wechat\work\traits;

trait LicenseTrait {
  /**
   * 下单购买帐号
   */
  public function createNewOrder(array $data)
  {
    $uri = "/cgi-bin/license/create_new_order?provider_access_token={$this->getProviderToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 创建续期任务
   */
  public function createRenewOrderJob(array $data)
  {
    $uri = "/cgi-bin/license/create_renew_order_job?provider_access_token={$this->getProviderToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 提交续期订单
   */
  public function submitOrderJob(array $data)
  {
    $uri = "/cgi-bin/license/submit_order_job?provider_access_token={$this->getProviderToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取订单列表
   */
  public function getOrderList(array $data)
  {
    $uri = "/cgi-bin/license/list_order?provider_access_token={$this->getProviderToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取订单详情
   */
  public function getOrderInfo(string $orderId)
  {
    $uri = "/cgi-bin/license/get_order?provider_access_token={$this->getProviderToken()}";
    $this->httpPost($uri, json_encode([
      'order_id'=> $orderId
    ]));
    return $this->getResponse();
  }

  /**
   * 获取订单中的帐号列表
   */
  public function listOrderAccount(string $orderId, $cursor = '', $limit =  100)
  {
    $uri = "/cgi-bin/license/list_order_account?provider_access_token={$this->getProviderToken()}";
    $this->httpPost($uri, json_encode([
      "order_id"=> $orderId,
      "limit"=> $limit,
      "cursor"=> $cursor
    ]));
    return $this->getResponse();
  }

  /**
   * 取消订单
   */
  public function cancelOrder(string $orderId)
  {
    $uri = "/cgi-bin/license/cancel_order?provider_access_token={$this->getProviderToken()}";
    $this->httpPost($uri, json_encode([
      "corpid"=> $this->appid,
	    "order_id"=> $orderId
    ]));
    return $this->getResponse();
  }

  /**
   * 激活帐号
   */
  public function activeAccount(string $userid, $activeCode)
  {
    $uri = "/cgi-bin/license/active_account?provider_access_token={$this->getProviderToken()}";
    $this->httpPost($uri, json_encode([
      "corpid"=> $this->appid,
	    "active_code"=> $activeCode,
      "userid"=> $userid
    ]));
    return $this->getResponse();
  }

  /**
   * 批量激活帐号
   */
  public function batchActiveAccount(array $activeList)
  {
    $uri = "/cgi-bin/license/batch_active_account?provider_access_token={$this->getProviderToken()}";
    $this->httpPost($uri, json_encode([
      "corpid"=> $this->appid,
	    "active_list"=> $activeList
    ]));
    return $this->getResponse();
  }

  /**
   * 获取激活码详情
   */
  public function getActiveInfoByCode(string $activeCode)
  {
    $uri = "/cgi-bin/license/get_active_info_by_code?provider_access_token={$this->getProviderToken()}";
    $this->httpPost($uri, json_encode([
      "corpid"=> $this->appid,
	    "active_code"=> $activeCode
    ]));
    return $this->getResponse();
  }

  /**
   * 批量获取激活码详情
   */
  public function batchGetActiveInfoByCode(array $activeCodeList)
  {
    $uri = "/cgi-bin/license/batch_get_active_info_by_code?provider_access_token={$this->getProviderToken()}";
    $this->httpPost($uri, json_encode([
      "corpid"=> $this->appid,
	    "active_code_list"=> $activeCodeList
    ]));
    return $this->getResponse();
  }

  /**
   * 获取企业的帐号列表
   */
  public function listActivedAccount(string $activeCodeList, $cursor = '', $limit = 500)
  {
    $uri = "/cgi-bin/license/list_actived_account?provider_access_token={$this->getProviderToken()}";
    $this->httpPost($uri, json_encode([
      "corpid"=> $this->appid,
      "limit"=> $limit,
      "cursor"=> $cursor
    ]));
    return $this->getResponse();
  }

  /**
   * 获取成员的激活详情
   */
  public function getActiveInfoByUser(string $userid)
  {
    $uri = "/cgi-bin/license/get_active_info_by_user?provider_access_token={$this->getProviderToken()}";
    $this->httpPost($uri, json_encode([
      "corpid"=> $this->appid,
      "userid"=> $userid
    ]));
    return $this->getResponse();
  }

  /**
   * 帐号继承
   */
  public function batchTransferLicense(array $transferList)
  {
    $uri = "/cgi-bin/license/batch_transfer_license?provider_access_token={$this->getProviderToken()}";
    $this->httpPost($uri, json_encode([
      "corpid"=> $this->appid,
      "transfer_list"=> $transferList
    ]));
    return $this->getResponse();
  }

  /**
   * 分配激活码给下游企业
   */
  public function batchShareActiveCode(string $toCorpid, array $shareList)
  {
    $uri = "/cgi-bin/license/batch_share_active_code?provider_access_token={$this->getProviderToken()}";
    $this->httpPost($uri, json_encode([
      "from_corpid"=> $this->appid,
      "to_corpid"=> $toCorpid,
      "share_list"=> $shareList
    ]));
    return $this->getResponse();
  }

  /**
   * 获取应用的接口许可状态
   */
  public function getAppLicenseInfo(string $suiteId)
  {
    $uri = "/cgi-bin/license/get_app_license_info?provider_access_token={$this->getProviderToken()}";
    $this->httpPost($uri, json_encode([
      "corpid"=> $this->appid,
      "suite_id"=> $suiteId
    ]));
    return $this->getResponse();
  }

  /**
   * 设置企业的许可自动激活状态
   */
  public function setAutoActiveStatus(string $autoActiveStatus = 1)
  {
    $uri = "/cgi-bin/license/set_auto_active_status?provider_access_token={$this->getProviderToken()}";
    $this->httpPost($uri, json_encode([
      "corpid"=> $this->appid,
      "auto_active_status"=> $autoActiveStatus
    ]));
    return $this->getResponse();
  }

  /**
   * 查询企业的许可自动激活状态
   */
  public function getAutoActiveStatus()
  {
    $uri = "/cgi-bin/license/get_auto_active_status?provider_access_token={$this->getProviderToken()}";
    $this->httpPost($uri, json_encode([
      "corpid"=> $this->appid,
    ]));
    return $this->getResponse();
  }
}