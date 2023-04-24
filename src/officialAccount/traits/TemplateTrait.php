<?php

namespace Fushengfu\Wechat\officialAccount\traits;

trait TemplateTrait {
  /**
   * 设置所属行业
   */
  public function apiSetIndustry(array $data)
  {
    $this->httpPost('/cgi-bin/template/api_set_industry?access_token='.$this->getAccessToken(), json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取设置的行业信息
   */
  public function getIndustry()
  {
    $this->httpGet('/cgi-bin/template/get_industry?access_token='.$this->getAccessToken());
    return $this->getResponse();
  }

  /**
   * 获得模板ID
   */
  public function apiAddTemplate(array $data)
  {
    $this->httpPost('/cgi-bin/template/api_add_template?access_token='.$this->getAccessToken(), json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取模板列表
   */
  public function getAllPrivateTemplate()
  {
    $this->httpGet('/cgi-bin/template/get_all_private_template?access_token='.$this->getAccessToken());
    return $this->getResponse();
  }

  /**
   * 删除模板
   */
  public function delPrivateTemplate(array $data)
  {
    $this->httpPost('/cgi-bin/template/del_private_template?access_token='.$this->getAccessToken(), json_encode($data));
    return $this->getResponse();
  }

  /**
   * 发送模板消息
   */
  public function messageTemplateSend(array $data)
  {
    $this->httpPost('/cgi-bin/message/template/send?access_token='.$this->getAccessToken(), json_encode($data));
    return $this->getResponse();
  }
}