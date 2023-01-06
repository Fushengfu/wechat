<?php
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
    return $this->http->getResponse();
  }

  /**
   * 获取客户列表
   */
  public function getExternalUserList(string $userid)
  {
    $this->httpGet("/cgi-bin/externalcontact/list?access_token={$this->getAccessToken()}&userid={$userid}");
    return $this->http->getResponse();
  }

  /**
   * 获取客户详情
   */
  public function getExternalUserInfo(string $externalUserid, $cursor)
  {
    $this->httpGet("/cgi-bin/externalcontact/get?access_token={$this->getAccessToken()}&external_userid={$externalUserid}&cursor={$cursor}");
    return $this->http->getResponse();
  }

  /**
   * 批量获取客户详情
   */
  public function batchGetExternalUserInfo(string $data)
  {
    $uri = "/cgi-bin/externalcontact/batch/get_by_user?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 修改客户备注信息
   */
  public function remark(string $data)
  {
    $uri = "/cgi-bin/externalcontact/remark?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 企业主体unionid转换为第三方external_userid
   */
  public function unionidToExternalUserid(string $data)
  {
    $uri = "/cgi-bin/externalcontact/unionid_to_external_userid?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 第三方主体unionid转换为第三方external_userid
   */
  public function unionidToExternalUserid3rd(string $data)
  {
    $uri = "/cgi-bin/service/externalcontact/unionid_to_external_userid_3rd?suite_access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 代开发应用external_userid转换
   */
  public function toServiceExternalUserid(string $data)
  {
    $uri = "/cgi-bin/externalcontact/to_service_external_userid?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取企业标签库
   */
  public function getCorpTagList(string $data)
  {
    $uri = "/cgi-bin/externalcontact/get_corp_tag_list?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 添加企业客户标签
   */
  public function addCorpTag(string $data)
  {
    $uri = "/cgi-bin/externalcontact/add_corp_tag?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 编辑企业客户标签
   */
  public function editCorpTag(string $data)
  {
    $uri = "/cgi-bin/externalcontact/edit_corp_tag?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 删除企业客户标签
   */
  public function delCorpTag(string $data)
  {
    $uri = "/cgi-bin/externalcontact/del_corp_tag?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 编辑客户企业标签
   */
  public function markTag(string $data)
  {
    $uri = "/cgi-bin/externalcontact/mark_tag?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 分配在职成员的客户
   */
  public function transferCustomer(string $data)
  {
    $uri = "/cgi-bin/externalcontact/transfer_customer?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 查询客户接替状态
   */
  public function transferResult(string $data)
  {
    $uri = "/cgi-bin/externalcontact/transfer_result?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 分配在职成员的客户群
   */
  public function onjobTransfer(string $data)
  {
    $uri = "/cgi-bin/externalcontact/groupchat/onjob_transfer?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取待分配的离职成员列表
   */
  public function getUnassignedList(string $data)
  {
    $uri = "/cgi-bin/externalcontact/get_unassigned_list?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 分配离职成员的客户
   */
  public function resignedTransferCustomer(string $data)
  {
    $uri = "/cgi-bin/externalcontact/resigned/transfer_customer?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 查询客户接替状态
   */
  public function resignedTransferResult(string $data)
  {
    $uri = "/cgi-bin/externalcontact/resigned/transfer_result?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 分配离职成员的客户群
   */
  public function groupchatTransfer(string $data)
  {
    $uri = "/cgi-bin/externalcontact/groupchat/transfer?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取客户群列表
   */
  public function groupchatList(string $data)
  {
    $uri = "/cgi-bin/externalcontact/groupchat/list?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取客户群详情
   */
  public function getGroupchatDetail(string $data)
  {
    $uri = "/cgi-bin/externalcontact/groupchat/get?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 客户群opengid转换
   */
  public function opengidToChatid(string $data)
  {
    $uri = "/cgi-bin/externalcontact/opengid_to_chatid?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 配置客户联系「联系我」方式
   */
  public function addContactWay(string $data)
  {
    $uri = "/cgi-bin/externalcontact/add_contact_way?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取企业已配置的「联系我」方式
   */
  public function getContactWay(string $data)
  {
    $uri = "/cgi-bin/externalcontact/get_contact_way?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取企业已配置的「联系我」列表
   */
  public function listContactWay(string $data)
  {
    $uri = "/cgi-bin/externalcontact/list_contact_way?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 更新企业已配置的「联系我」方式
   */
  public function updateContactWay(string $data)
  {
    $uri = "/cgi-bin/externalcontact/update_contact_way?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 删除企业已配置的「联系我」方式
   */
  public function delContactWay(string $data)
  {
    $uri = "/cgi-bin/externalcontact/del_contact_way?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 结束临时会话
   */
  public function closeTempChat(string $data)
  {
    $uri = "/cgi-bin/externalcontact/close_temp_chat?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 创建发表任务
   */
  public function addMomentTask(string $data)
  {
    $uri = "/cgi-bin/externalcontact/add_moment_task?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取任务创建结果
   */
  public function getMomentTaskResult(string $jobid)
  {
    $uri = "/cgi-bin/externalcontact/get_moment_task_result?access_token={$this->getAccessToken()}&jobid={$jobid}";
    $this->httpGet($uri);
    return $this->http->getResponse();
  }

  /**
   * 停止发表企业朋友圈
   */
  public function cancelMomentTask(array $data)
  {
    $uri = "/cgi-bin/externalcontact/cancel_moment_task?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取企业全部的发表列表
   */
  public function getMomentList(array $data)
  {
    $uri = "/cgi-bin/externalcontact/get_moment_list?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取客户朋友圈企业发表的列表
   */
  public function getMomentTask(array $data)
  {
    $uri = "/cgi-bin/externalcontact/get_moment_task?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取客户朋友圈发表时选择的可见范围
   */
  public function getMomentCustomerList(array $data)
  {
    $uri = "/cgi-bin/externalcontact/get_moment_customer_list?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取客户朋友圈发表后的可见客户列表
   */
  public function getMomentSendResult(array $data)
  {
    $uri = "/cgi-bin/externalcontact/get_moment_send_result?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取客户朋友圈的互动数据
   */
  public function getMomentComments(array $data)
  {
    $uri = "/cgi-bin/externalcontact/get_moment_comments?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 创建企业群发
   */
  public function addMsgTemplate(array $data)
  {
    $uri = "/cgi-bin/externalcontact/add_msg_template?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 提醒成员群发
   */
  public function remindGroupmsgSend(array $data)
  {
    $uri = "/cgi-bin/externalcontact/remind_groupmsg_send?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 停止企业群发
   */
  public function cancelGroupmsgSend(array $data)
  {
    $uri = "/cgi-bin/externalcontact/cancel_groupmsg_send?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取群发记录列表
   */
  public function getGroupmsgListV2(array $data)
  {
    $uri = "/cgi-bin/externalcontact/get_groupmsg_list_v2?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取群发成员发送任务列表
   */
  public function getGroupmsgTask(array $data)
  {
    $uri = "/cgi-bin/externalcontact/get_groupmsg_task?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取企业群发成员执行结果
   */
  public function getGroupmsgSendResult(array $data)
  {
    $uri = "/cgi-bin/externalcontact/get_groupmsg_send_result?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 发送新客户欢迎语
   */
  public function sendWelcomeMsg(array $data)
  {
    $uri = "/cgi-bin/externalcontact/send_welcome_msg?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 添加入群欢迎语素材
   */
  public function groupWelcomeTemplateAdd(array $data)
  {
    $uri = "/cgi-bin/externalcontact/group_welcome_template/add?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 编辑入群欢迎语素材
   */
  public function groupWelcomeTemplateEdit(array $data)
  {
    $uri = "/cgi-bin/externalcontact/group_welcome_template/edit?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取入群欢迎语素材
   */
  public function groupWelcomeTemplateGet(array $data)
  {
    $uri = "/cgi-bin/externalcontact/group_welcome_template/get?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 删除入群欢迎语素材
   */
  public function groupWelcomeTemplateDel(array $data)
  {
    $uri = "/cgi-bin/externalcontact/group_welcome_template/del?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取「联系客户统计」数据
   */
  public function getUserBehaviorData(array $data)
  {
    $uri = "/cgi-bin/externalcontact/get_user_behavior_data?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取「群聊数据统计」数据
   * 按群主聚合的方式
   */
  public function groupchatStatistic(array $data)
  {
    $uri = "/cgi-bin/externalcontact/groupchat/statistic?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取「群聊数据统计」数据
   * 按自然日聚合的方式
   */
  public function groupchatStatisticGroupByDay(array $data)
  {
    $uri = "/cgi-bin/externalcontact/groupchat/statistic_group_by_day?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 创建商品图册
   */
  public function addProductAlbum(array $data)
  {
    $uri = "/cgi-bin/externalcontact/add_product_album?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取商品图册
   */
  public function getProductAlbum(array $data)
  {
    $uri = "/cgi-bin/externalcontact/get_product_album?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取商品图册列表
   */
  public function getProductAlbumList(array $data)
  {
    $uri = "/cgi-bin/externalcontact/get_product_album_list?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 编辑商品图册
   */
  public function updateProductAlbum(array $data)
  {
    $uri = "/cgi-bin/externalcontact/update_product_album?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 删除商品图册
   */
  public function daleteProductAlbum(array $data)
  {
    $uri = "/cgi-bin/externalcontact/delete_product_album?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 新建敏感词规则
   */
  public function addInterceptRule(array $data)
  {
    $uri = "/cgi-bin/externalcontact/add_intercept_rule?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取敏感词规则列表
   */
  public function getInterceptRuleList(array $data)
  {
    $uri = "/cgi-bin/externalcontact/get_intercept_rule_list?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取敏感词规则详情
   */
  public function getInterceptRule(array $data)
  {
    $uri = "/cgi-bin/externalcontact/get_intercept_rule?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 修改敏感词规则
   */
  public function updateInterceptRule(array $data)
  {
    $uri = "/cgi-bin/externalcontact/update_intercept_rule?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 删除敏感词规则
   */
  public function delInterceptRule(array $data)
  {
    $uri = "/cgi-bin/externalcontact/del_intercept_rule?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 上传附件资源
   */
  public function uploadAttachment(array $data)
  {
    $uri = "/cgi-bin/media/upload_attachment?access_token={$this->getAccessToken()}&media_type={$data['media_type']}&attachment_type={$data['attachment_type']}";
    $this->httpPost($uri, $data);
    return $this->http->getResponse();
  }

  /**
   * 添加客服帐号
   */
  public function kfAccountAdd(array $data)
  {
    $uri = "/cgi-bin/kf/account/add?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, $data);
    return $this->http->getResponse();
  }

  /**
   * 删除客服帐号
   */
  public function kfAccountDel(array $data)
  {
    $uri = "/cgi-bin/kf/account/del?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, $data);
    return $this->http->getResponse();
  }

  /**
   * 修改客服帐号
   */
  public function kfAccountUpdate(array $data)
  {
    $uri = "/cgi-bin/kf/account/update?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, $data);
    return $this->http->getResponse();
  }

  /**
   * 获取客服帐号列表
   */
  public function kfAccountList(array $data)
  {
    $uri = "/cgi-bin/kf/account/list?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, $data);
    return $this->http->getResponse();
  }

  /**
   * 获取客服帐号链接
   */
  public function kfAddContactWay(array $data)
  {
    $uri = "/cgi-bin/kf/add_contact_way?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, $data);
    return $this->http->getResponse();
  }

  /**
   * 添加接待人员
   */
  public function kfServicerAdd(array $data)
  {
    $uri = "/cgi-bin/kf/servicer/add?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, $data);
    return $this->http->getResponse();
  }

  /**
   * 删除接待人员
   */
  public function kfServicerDel(array $data)
  {
    $uri = "/cgi-bin/kf/servicer/del?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, $data);
    return $this->http->getResponse();
  }

  /**
   * 删除接待人员
   */
  public function kfServicerList()
  {
    $uri = "/cgi-bin/kf/servicer/list?access_token={$this->getAccessToken()}";
    $this->httpGet($uri);
    return $this->http->getResponse();
  }

  /**
   * 获取会话状态
   */
  public function kfServiceStateGet()
  {
    $uri = "/cgi-bin/kf/service_state/get?access_token={$this->getAccessToken()}";
    $this->httpGet($uri);
    return $this->http->getResponse();
  }

  /**
   * 变更会话状态
   */
  public function kfServiceStateTrans()
  {
    $uri = "/cgi-bin/kf/service_state/trans?access_token={$this->getAccessToken()}";
    $this->httpGet($uri);
    return $this->http->getResponse();
  }

  /**
   * 发送消息
   */
  public function kfSendMsg(array $data)
  {
    $uri = "/cgi-bin/kf/send_msg?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取客户基础信息
   */
  public function kfCustomerBatchget(array $data)
  {
    $uri = "/cgi-bin/kf/customer/batchget?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取视频号绑定状态
   */
  public function getCorpQualification()
  {
    $uri = "/cgi-bin/kf/get_corp_qualification?access_token={$this->getAccessToken()}";
    $this->httpGet($uri);
    return $this->http->getResponse();
  }

  /**
   * 获取「客户数据统计」企业汇总数据
   */
  public function getCorpStatistic(array $data)
  {
    $uri = "/cgi-bin/kf/get_corp_statistic?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取「客户数据统计」接待人员明细数据
   */
  public function getServicerStatistic(array $data)
  {
    $uri = "/cgi-bin/kf/get_servicer_statistic?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 企业和服务商可通过此接口获取企业的对外收款记录
   */
  public function externalpayGetBillList(array $data)
  {
    $uri = "/cgi-bin/externalpay/get_bill_list?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取收款项目的商户单号
   */
  public function externalpayGetPaymentInfo(array $data)
  {
    $uri = "/cgi-bin/externalpay/get_payment_info?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }
}