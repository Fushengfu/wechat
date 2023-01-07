<?php
namespace Fushengfu\Wechat\work\traits;

trait DepartmentTrait {
  /**
   * 创建部门
   */
  public function createDepartment(array $data)
  {
    $uri = "/cgi-bin/department/create?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 更新部门
   */
  public function updateDepartment(array $data)
  {
    $uri = "/cgi-bin/department/update?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 删除部门
   */
  public function deleteDepartment(string $id)
  {
    $uri = "/cgi-bin/department/delete?access_token={$this->getAccessToken()}&id={$id}";
    $this->httpGet($uri);
    return $this->getResponse();
  }

  /**
   * 获取部门列表
   */
  public function getDepartmentList(string $id = '')
  {
    $uri = "/cgi-bin/department/list?access_token={$this->getAccessToken()}&id={$id}";
    $this->httpGet($uri);
    return $this->getResponse();
  }

  /**
   * 获取子部门ID列表
   */
  public function getDepartmentById(string $id)
  {
    $uri = "/cgi-bin/department/simplelist?access_token={$this->getAccessToken()}&id={$id}";
    $this->httpGet($uri);
    return $this->getResponse();
  }

  /**
   * 获取单个部门详情
   */
  public function getDepartmentInfo(string $id)
  {
    $uri = "/cgi-bin/department/get?access_token={$this->getAccessToken()}&id={$id}";
    $this->httpGet($uri);
    return $this->getResponse();
  }
}