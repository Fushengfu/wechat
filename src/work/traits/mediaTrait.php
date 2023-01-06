<?php
trait MediaTrait {
  /**
   * 上传临时素材
   */
  public function upload(array $data)
  {
    $uri = "/cgi-bin/media/upload?access_token={$this->getAccessToken()}&type={$data['type']}";
    $this->httpPost($uri, $data);
    return $this->http->getResponse();
  }

  /**
   * 上传图片
   * 图片文件大小应在 5B ~ 2MB 之间
   */
  public function uploadimg(array $data)
  {
    $uri = "/cgi-bin/media/uploadimg?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, $data);
    return $this->http->getResponse();
  }

  /**
   * 获取临时素材
   */
  public function mediaGet(string $mediaId)
  {
    $uri = "/cgi-bin/media/get?access_token={$this->getAccessToken()}&media_id={$mediaId}";
    $this->httpGet($uri);
    return $this->http->getResponse();
  }
}