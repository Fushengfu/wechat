<?php
namespace Fushengfu\Wechat\work\traits;

trait TagTrait {
  /**
   * 创建标签
   */
  public function createTag(array $data)
  {
    $uri = "/cgi-bin/tag/create?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 更新标签名字
   */
  public function updateTag(array $data)
  {
    $uri = "/cgi-bin/tag/update?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 删除标签
   */
  public function deleteTag(string $tagid)
  {
    $uri = "/cgi-bin/tag/delete?access_token={$this->getAccessToken()}&tagid={$tagid}";
    $this->httpGet($uri);
    return $this->getResponse();
  }

  /**
   * 获取标签成员
   */
  public function getTagUser(string $tagid)
  {
    $uri = "/cgi-bin/tag/get?access_token={$this->getAccessToken()}&tagid={$tagid}";
    $this->httpGet($uri);
    return $this->getResponse();
  }

  /**
   * 增加标签成员
   */
  public function addTagUsers(array $data)
  {
    $uri = "/cgi-bin/tag/addtagusers?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 删除标签成员
   */
  public function delTagUsers(array $data)
  {
    $uri = "/cgi-bin/tag/deltagusers?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取标签列表
   */
  public function getTagList()
  {
    $uri = "/cgi-bin/tag/list?access_token={$this->getAccessToken()}";
    $this->httpGet($uri);
    return $this->getResponse();
  }
}