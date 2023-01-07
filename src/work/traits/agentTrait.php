<?php
namespace Fushengfu\Wechat\work\traits;

trait AgentTrait {
  /**
   * 获取指定的应用详情
   */
  public function agentInfo(string $agentid)
  {
    $uri = "/cgi-bin/agent/get?access_token={$this->getAccessToken()}&agentid={$agentid}";
    $this->httpGet($uri);
    return $this->getResponse();
  }

  /**
   * 获取access_token对应的应用列表
   */
  public function agentList()
  {
    $uri = "/cgi-bin/agent/list?access_token={$this->getAccessToken()}";
    $this->httpGet($uri);
    return $this->getResponse();
  }

  /**
   * 设置应用在工作台展示的模版
   */
  public function setWorkbenchTemplate(array $data)
  {
    $uri = "/cgi-bin/agent/set_workbench_template?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }

  /**
   * 获取应用在工作台展示的模版
   */
  public function getWorkbenchTemplate(string $agentid)
  {
    $uri = "/cgi-bin/agent/get_workbench_template?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode(['agentid'=> $agentid]));
    return $this->getResponse();
  }

  /**
   * 设置应用在用户工作台展示的数据
   */
  public function setWorkbenchData(array $data)
  {
    $uri = "/cgi-bin/agent/set_workbench_data?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->getResponse();
  }
}