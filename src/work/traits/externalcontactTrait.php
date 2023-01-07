<?php
namespace Fushengfu\Wechat\work\traits;

/**
 * 客户联系
 */
trait ExternalcontactTrait {
  /**
   * 获取配置了客户联系功能的成员列表
   */
  public function getFollowUserList()
  {
    $this->httpGet('/cgi-bin/externalcontact/get_follow_user_list?access_token='.$this->getAccessToken());
    return $this->getResponse();
  }

  /**
   * 获取客户列表
   */
  public function getExternalUserList(string $userid)
  {
    $this->httpGet("/cgi-bin/externalcontact/list?access_token={$this->getAccessToken()}&userid={$userid}");
    return $this->getResponse();
  }

  /**
   * 获取客户详情
   */
  public function getExternalUserInfo(string $externalUserid, $cursor = '')
  {
    $this->httpGet("/cgi-bin/externalcontact/get?access_token={$this->getAccessToken()}&external_userid={$externalUserid}&cursor={$cursor}");
    return $this->getResponse();
  }

  /**
   * 批量获取客户详情
   */
  public function batchGetExternalUserInfo(array $useridList, $limit = 100, $cursor = '')
  {
    $uri = "/cgi-bin/externalcontact/batch/get_by_user?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode([
      "userid_list"=> $useridList,
      "cursor"=> $cursor,
      "limit"=> $limit
    ]));
    return $this->getResponse();
  }

  /**
   * 修改客户备注信息
   */
  public function remark(array $data)
  {
    $uri = "/cgi-bin/externalcontact/remark?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 企业主体unionid转换为第三方external_userid
   */
  public function unionidToExternalUserid(array $data)
  {
    $uri = "/cgi-bin/externalcontact/unionid_to_external_userid?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 第三方主体unionid转换为第三方external_userid
   */
  public function unionidToExternalUserid3rd(array $data)
  {
    $uri = "/cgi-bin/service/externalcontact/unionid_to_external_userid_3rd?suite_access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 代开发应用external_userid转换
   */
  public function toServiceExternalUserid(array $data)
  {
    $uri = "/cgi-bin/externalcontact/to_service_external_userid?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取企业标签库
   */
  public function getCorpTagList(array $data = [])
  {
    $uri = "/cgi-bin/externalcontact/get_corp_tag_list?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 添加企业客户标签
   */
  public function addCorpTag(array $data)
  {
    $uri = "/cgi-bin/externalcontact/add_corp_tag?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 编辑企业客户标签
   */
  public function editCorpTag(array $data)
  {
    $uri = "/cgi-bin/externalcontact/edit_corp_tag?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 删除企业客户标签
   */
  public function delCorpTag(array $data)
  {
    $uri = "/cgi-bin/externalcontact/del_corp_tag?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 编辑客户企业标签
   */
  public function markTag(array $data)
  {
    $uri = "/cgi-bin/externalcontact/mark_tag?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 分配在职成员的客户
   */
  public function transferCustomer(array $data)
  {
    $uri = "/cgi-bin/externalcontact/transfer_customer?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 查询客户接替状态
   */
  public function transferResult(array $data)
  {
    $uri = "/cgi-bin/externalcontact/transfer_result?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 分配在职成员的客户群
   */
  public function onjobTransfer(array $data)
  {
    $uri = "/cgi-bin/externalcontact/groupchat/onjob_transfer?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取待分配的离职成员列表
   */
  public function getUnassignedList(array $data = [])
  {
    $uri = "/cgi-bin/externalcontact/get_unassigned_list?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 分配离职成员的客户
   */
  public function resignedTransferCustomer(array $data)
  {
    $uri = "/cgi-bin/externalcontact/resigned/transfer_customer?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 查询客户接替状态
   */
  public function resignedTransferResult(array $data)
  {
    $uri = "/cgi-bin/externalcontact/resigned/transfer_result?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 分配离职成员的客户群
   */
  public function groupchatTransfer(array $data)
  {
    $uri = "/cgi-bin/externalcontact/groupchat/transfer?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取客户群列表
   */
  public function groupchatList(array $data)
  {
    $uri = "/cgi-bin/externalcontact/groupchat/list?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取客户群详情
   */
  public function getGroupchatDetail(string $chatId, $needName = 1)
  {
    $uri = "/cgi-bin/externalcontact/groupchat/get?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode([
      'chat_id'=> $chatId,
      'need_name'=> $needName,
    ]));
    return $this->getResponse();
  }

  /**
   * 客户群opengid转换
   */
  public function opengidToChatid(string $opengid)
  {
    $uri = "/cgi-bin/externalcontact/opengid_to_chatid?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode([
      'opengid'=> $opengid
    ]));
    return $this->getResponse();
  }

  /**
   * 配置客户联系「联系我」方式
   */
  public function addContactWay(array $data)
  {
    $uri = "/cgi-bin/externalcontact/add_contact_way?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取企业已配置的「联系我」方式
   */
  public function getContactWay(string $configId)
  {
    $uri = "/cgi-bin/externalcontact/get_contact_way?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode([
      'config_id'=> $configId
    ]));
    return $this->getResponse();
  }

  /**
   * 获取企业已配置的「联系我」列表
   */
  public function listContactWay(array $data = [])
  {
    $uri = "/cgi-bin/externalcontact/list_contact_way?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 更新企业已配置的「联系我」方式
   */
  public function updateContactWay(array $data)
  {
    $uri = "/cgi-bin/externalcontact/update_contact_way?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 删除企业已配置的「联系我」方式
   */
  public function delContactWay(array $data)
  {
    $uri = "/cgi-bin/externalcontact/del_contact_way?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 结束临时会话
   */
  public function closeTempChat(array $data)
  {
    $uri = "/cgi-bin/externalcontact/close_temp_chat?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 创建发表任务
   */
  public function addMomentTask(array $data)
  {
    $uri = "/cgi-bin/externalcontact/add_moment_task?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取任务创建结果
   */
  public function getMomentTaskResult(string $jobid)
  {
    $uri = "/cgi-bin/externalcontact/get_moment_task_result?access_token={$this->getAccessToken()}&jobid={$jobid}";
    $this->httpGet($uri);
    return $this->getResponse();
  }

  /**
   * 停止发表企业朋友圈
   */
  public function cancelMomentTask(array $data)
  {
    $uri = "/cgi-bin/externalcontact/cancel_moment_task?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取企业全部的发表列表
   */
  public function getMomentList(array $data)
  {
    $uri = "/cgi-bin/externalcontact/get_moment_list?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取客户朋友圈企业发表的列表
   */
  // {
  //   "start_time":1605000000,
  //   "end_time":1605172726,
  //   "creator":"zhangsan",
  //   "filter_type":1,
  //   "cursor":"CURSOR",
  //   "limit":10
  // }
  public function getMomentTask(array $data)
  {
    $uri = "/cgi-bin/externalcontact/get_moment_task?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取客户朋友圈发表时选择的可见范围
   */
  public function getMomentCustomerList(array $data)
  {
    $uri = "/cgi-bin/externalcontact/get_moment_customer_list?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取客户朋友圈发表后的可见客户列表
   */
  public function getMomentSendResult(array $data)
  {
    $uri = "/cgi-bin/externalcontact/get_moment_send_result?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取客户朋友圈的互动数据
   */
  public function getMomentComments(array $data)
  {
    $uri = "/cgi-bin/externalcontact/get_moment_comments?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 创建企业群发
   */
  public function addMsgTemplate(array $data)
  {
    $uri = "/cgi-bin/externalcontact/add_msg_template?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 提醒成员群发
   */
  public function remindGroupmsgSend(array $data)
  {
    $uri = "/cgi-bin/externalcontact/remind_groupmsg_send?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 停止企业群发
   */
  public function cancelGroupmsgSend(array $data)
  {
    $uri = "/cgi-bin/externalcontact/cancel_groupmsg_send?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取群发记录列表
   */
  public function getGroupmsgListV2(array $data)
  {
    $uri = "/cgi-bin/externalcontact/get_groupmsg_list_v2?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取群发成员发送任务列表
   */
  public function getGroupmsgTask(array $data)
  {
    $uri = "/cgi-bin/externalcontact/get_groupmsg_task?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取企业群发成员执行结果
   */
  public function getGroupmsgSendResult(array $data)
  {
    $uri = "/cgi-bin/externalcontact/get_groupmsg_send_result?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 发送新客户欢迎语
   */
  public function sendWelcomeMsg(array $data)
  {
    $uri = "/cgi-bin/externalcontact/send_welcome_msg?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 添加入群欢迎语素材
   */
  public function groupWelcomeTemplateAdd(array $data)
  {
    $uri = "/cgi-bin/externalcontact/group_welcome_template/add?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 编辑入群欢迎语素材
   */
  public function groupWelcomeTemplateEdit(array $data)
  {
    $uri = "/cgi-bin/externalcontact/group_welcome_template/edit?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取入群欢迎语素材
   */
  public function groupWelcomeTemplateGet(array $data)
  {
    $uri = "/cgi-bin/externalcontact/group_welcome_template/get?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 删除入群欢迎语素材
   */
  public function groupWelcomeTemplateDel(array $data)
  {
    $uri = "/cgi-bin/externalcontact/group_welcome_template/del?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取「联系客户统计」数据
   */
  public function getUserBehaviorData(array $data)
  {
    $uri = "/cgi-bin/externalcontact/get_user_behavior_data?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取「群聊数据统计」数据
   * 按群主聚合的方式
   */
  public function groupchatStatistic(array $data)
  {
    $uri = "/cgi-bin/externalcontact/groupchat/statistic?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取「群聊数据统计」数据
   * 按自然日聚合的方式
   */
  public function groupchatStatisticGroupByDay(array $data)
  {
    $uri = "/cgi-bin/externalcontact/groupchat/statistic_group_by_day?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 创建商品图册
   */
  public function addProductAlbum(array $data)
  {
    $uri = "/cgi-bin/externalcontact/add_product_album?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取商品图册
   */
  public function getProductAlbum(array $data)
  {
    $uri = "/cgi-bin/externalcontact/get_product_album?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取商品图册列表
   */
  public function getProductAlbumList(array $data)
  {
    $uri = "/cgi-bin/externalcontact/get_product_album_list?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 编辑商品图册
   */
  public function updateProductAlbum(array $data)
  {
    $uri = "/cgi-bin/externalcontact/update_product_album?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 删除商品图册
   */
  public function daleteProductAlbum(array $data)
  {
    $uri = "/cgi-bin/externalcontact/delete_product_album?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 新建敏感词规则
   */
  public function addInterceptRule(array $data)
  {
    $uri = "/cgi-bin/externalcontact/add_intercept_rule?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取敏感词规则列表
   */
  public function getInterceptRuleList()
  {
    $uri = "/cgi-bin/externalcontact/get_intercept_rule_list?access_token={$this->getAccessToken()}";
    $this->httpGet($uri);
    return $this->getResponse();
  }

  /**
   * 获取敏感词规则详情
   */
  public function getInterceptRule(int $ruleId)
  {
    $uri = "/cgi-bin/externalcontact/get_intercept_rule?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode([
      'rule_id'=> $ruleId
    ]));
    return $this->getResponse();
  }

  /**
   * 修改敏感词规则
   */
  public function updateInterceptRule(array $data)
  {
    $uri = "/cgi-bin/externalcontact/update_intercept_rule?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 删除敏感词规则
   */
  public function delInterceptRule(array $data)
  {
    $uri = "/cgi-bin/externalcontact/del_intercept_rule?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 上传附件资源
   */
  public function uploadAttachment(array $data)
  {
    $uri = "/cgi-bin/media/upload_attachment?access_token={$this->getAccessToken()}&media_type={$data['media_type']}&attachment_type={$data['attachment_type']}";
    $this->httpPost($uri, $data);
    return $this->getResponse();
  }
  
  /**
   * 企业和服务商可通过此接口获取企业的对外收款记录
   */
  public function externalpayGetBillList(array $data)
  {
    $uri = "/cgi-bin/externalpay/get_bill_list?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取收款项目的商户单号
   */
  public function externalpayGetPaymentInfo(array $data)
  {
    $uri = "/cgi-bin/externalpay/get_payment_info?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }
}