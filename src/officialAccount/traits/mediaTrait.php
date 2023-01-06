<?php

namespace Fushengfu\Wechat\officialAccount\traits;

trait MediaTrait {
  /**
   * 上传图文消息内的图片获取URL
   */
  public function uploadimg(array $data)
  {
    $this->httpPost('/cgi-bin/media/uploadimg?access_token='.$this->getAccessToken(), $data);
    return $this->http->getResponse();
  }

  /**
   * 上传图文消息素材
   */
  public function uploadnews(array $data)
  {
    $this->httpPost('/cgi-bin/media/uploadnews?access_token='.$this->getAccessToken(), json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 根据 OpenID 列表群发
   */
  public function messageMassSend(array $data)
  {
    $this->httpPost('/cgi-bin/message/mass/send?access_token='.$this->getAccessToken(), json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 删除群发
   */
  public function messageMassDelete(array $data)
  {
    $this->httpPost('/cgi-bin/message/mass/delete?access_token='.$this->getAccessToken(), json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 预览接口
   */
  public function messageMassPreview(array $data)
  {
    $this->httpPost('/cgi-bin/message/mass/preview?access_token='.$this->getAccessToken(), json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 查询群发消息发送状态
   */
  public function messageMassGet(array $data)
  {
    $this->httpPost('/cgi-bin/message/mass/get?access_token='.$this->getAccessToken(), json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 设置群发速度
   */
  public function messageMassSpeedSet(array $data)
  {
    $this->httpPost('/cgi-bin/message/mass/speed/set?access_token='.$this->getAccessToken(), json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 新增临时素材
   */
  public function upload(array $data)
  {
    $this->httpPost("/cgi-bin/media/upload?access_token={$this->getAccessToken()}&type={$data['type']}", $data);
    return $this->http->getResponse();
  }

  /**
   * 获取临时素材
   */
  public function mediaGet(string $mediaId)
  {
    $this->httpGet("/cgi-bin/media/get?access_token={$this->getAccessToken()}&media_id={$mediaId}");
    return $this->http->getResponse();
  }

  /**
   * 获取永久素材
   */
  public function getMaterial(array $data)
  {
    $this->httpPost("/cgi-bin/material/get_material?access_token={$this->getAccessToken()}", json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 删除永久素材
   */
  public function delMaterial(array $data)
  {
    $this->httpPost("/cgi-bin/material/del_material?access_token={$this->getAccessToken()}", json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取素材总数
   */
  public function getMaterialcount()
  {
    $this->httpGet("/cgi-bin/material/get_materialcount?access_token={$this->getAccessToken()}");
    return $this->http->getResponse();
  }

  /**
   * 获取素材列表
   */
  public function batchgetMaterial(array $data)
  {
    $this->httpPost("/cgi-bin/material/batchget_material?access_token={$this->getAccessToken()}", json_encode($data));
    return $this->http->getResponse();
  }
}