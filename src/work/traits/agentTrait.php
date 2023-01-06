<?php
trait AgentTrait {
  /**
   * 获取指定的应用详情
   */
  public function agentGet(string $agentid)
  {
    $uri = "/cgi-bin/agent/get?access_token={$this->getAccessToken()}&agentid={$agentid}";
    $this->httpGet($uri);
    return $this->http->getResponse();
  }

  /**
   * 获取access_token对应的应用列表
   */
  public function agentList()
  {
    $uri = "/cgi-bin/agent/list?access_token={$this->getAccessToken()}";
    $this->httpGet($uri);
    return $this->http->getResponse();
  }

  /**
   * 设置应用在工作台展示的模版
   */
  public function agentSetWorkbenchTemplate(array $data)
  {
    $uri = "/cgi-bin/agent/set_workbench_template?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 获取应用在工作台展示的模版
   */
  public function agentGetWorkbenchTemplate(array $data)
  {
    $uri = "/cgi-bin/agent/get_workbench_template?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }

  /**
   * 设置应用在用户工作台展示的数据
   */
  public function agentSetWorkbenchData(array $data)
  {
    $uri = "/cgi-bin/agent/set_workbench_data?access_token={$this->getAccessToken()}";
    $this->httpPost($uri, json_encode($data));
    return $this->http->getResponse();
  }
}