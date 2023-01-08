<?php

namespace Fushengfu\Wechat\officialAccount\traits;

trait MenuTrait {
  /**
   * 创建接口
   */
  public function menuCreate(array $data)
  {
    $this->httpPost('/cgi-bin/menu/create?access_token='.$this->getAccessToken(), json_encode($data));
    return $this->getResponse();
  }

  /**
   * 查询菜单接口
   */
  public function getCurrentMenu()
  {
    $this->httpGet('/cgi-bin/get_current_selfmenu_info?access_token='.$this->getAccessToken());
    return $this->getResponse();
  }

  /**
   * 删除接口
   */
  public function menuDelete()
  {
    $this->httpGet('/cgi-bin/menu/delete?access_token='.$this->getAccessToken());
    return $this->getResponse();
  }

  /**
   * 创建个性化菜单
   */
  public function menuAddconditional(array $data)
  {
    $this->httpPost('/cgi-bin/menu/addconditional?access_token='.$this->getAccessToken(), json_encode($data));
    return $this->getResponse();
  }

  /**
   * 删除个性化菜单
   */
  public function menuDelconditional(array $data)
  {
    $this->httpPost('/cgi-bin/menu/delconditional?access_token='.$this->getAccessToken(), json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取自定义菜单配置
   */
  public function menuGet()
  {
    $this->httpGet('/cgi-bin/menu/get?access_token='.$this->getAccessToken());
    return $this->getResponse();
  }
}