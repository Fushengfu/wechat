<?php
namespace Fushengfu\Wechat\work\traits;

trait UserTrait {
  /**
   * 创建成员
   */
  public function createUser(array $data)
  {
    $uri = "/cgi-bin/user/create?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 读取成员
   */
  public function getUserInfo(string $userid)
  {
    $uri = "/cgi-bin/user/get?access_token={$this->getAccessToken()}&userid={$userid}";
    $this->httpGet($uri);
    return $this->getResponse();
  }

  /**
   * 更新成员信息
   */
  public function updateUser(array $data)
  {
    $uri = "/cgi-bin/user/update?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 删除成员
   */
  public function deleteUser(array $data)
  {
    $uri = "/cgi-bin/user/delete?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 批量删除成员
   */
  public function batchDeleteUser(array $data)
  {
    $uri = "/cgi-bin/user/batchdelete?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取部门成员
   */
  public function getUserlist(string $departmentId)
  {
    $uri = "/cgi-bin/user/simplelist?access_token={$this->getAccessToken()}&department_id={$departmentId}";
    $this->httpGet($uri);
    return $this->getResponse();
  }

  /**
   * 获取部门成员
   */
  public function getUserInfoList(string $departmentId)
  {
    $uri = "/cgi-bin/user/list?access_token={$this->getAccessToken()}&department_id={$departmentId}";
    $this->httpGet($uri);
    return $this->getResponse();
  }

  /**
   * userid与openid互换
   */
  public function convertToOpenid(string $userid)
  {
    $uri = "/cgi-bin/user/convert_to_openid?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode([
      "userid"=> $userid
    ]));
    return $this->getResponse();
  }

  /**
   * openid转userid
   */
  public function convertToUserid(string $openid)
  {
    $uri = "/cgi-bin/user/convert_to_userid?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode([
      "openid"=> $openid
    ]));
    return $this->getResponse();
  }

  /**
   * 邀请成员
   */
  public function batchInvite(array $data)
  {
    $uri = "/cgi-bin/batch/invite?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode([
      "user"=> $data['user']??[],
      "party"=> $data['party']??[],
      "tag"=> $data['tag']??[]
    ]));
    return $this->getResponse();
  }

  /**
   * 手机号获取userid
   */
  public function getUseridByMobile(string $mobile)
  {
    $uri = "/cgi-bin/user/getuserid?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode([
      "mobile"=> $mobile
    ]));
    return $this->getResponse();
  }

  /**
   * 邮箱获取userid
   */
  public function getUseridByEmail(string $email, $emailType = 2)
  {
    $uri = "/cgi-bin/user/get_userid_by_email?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode([
      "email"=> $email,
      "email_type"=> $emailType
    ]));
    return $this->getResponse();
  }

  /**
   * 获取成员授权列表
   */
  public function getListMemberAuth(string $cursor = '', $limit = 20)
  {
    $uri = "/cgi-bin/user/list_member_auth?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode(array_filter([
      "cursor"=> $cursor,
	    "limit"=> 20
    ])));
    return $this->getResponse();
  }

  /**
   * 查询成员用户是否已授权
   */
  public function checkMemberAuth(string $openUserid)
  {
    $uri = "/cgi-bin/user/check_member_auth?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode([
      "open_userid"=> $openUserid,
    ]));
    return $this->getResponse();
  }

  /**
   * 获取选人ticket对应的用户
   */
  public function listSelectedTicketUser(string $selectedTicket)
  {
    $uri = "/cgi-bin/user/list_selected_ticket_user?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode([
      "selected_ticket"=> $selectedTicket,
    ]));
    return $this->getResponse();
  }

  /**
   * 获取成员ID列表
   */
  public function getUseridList(string $cursor = '', $limit = 1000)
  {
    $uri = "/cgi-bin/user/list_id?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode(array_filter([
      "cursor"=> $cursor,
	    "limit"=> $limit
    ])));
    return $this->getResponse();
  }
}