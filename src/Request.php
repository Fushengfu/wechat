<?php

namespace Fushengfu\Wechat;

/**
 * CURL网络请求管理器
 * Class Http
 * @package Amulet\tools
 */
class Request
{
    /**
     * 请求状态码
     */
    private $statusCode = 200;

    /**
     * 请求头
     */
    private $requestHeaders = [];

    /**
     * 请求结果
     */
    private $response = null;

    protected $xml;

    /**
     * 以get模拟网络请求
     * @param string $url HTTP请求URL地址
     * @param array $query GET请求参数
     * @param array $options CURL参数
     * @return boolean|string
     */
    public function get($url, $query = [], $options = [])
    {
        $options['query'] = $query;
        return $this->send('get', $url, $options);
    }

    /**
     * 以get模拟网络请求
     * @param string $url HTTP请求URL地址
     * @param array $data POST请求数据
     * @param array $options CURL参数
     * @return boolean|string
     */
    public function post($url, $data = [], $options = [])
    {
        $options['data'] = $data;
        return $this->send('post', $url, $options);
    }

    /**
     * CURL模拟网络请求
     * @param string $method 请求方法
     * @param string $url 请求方法
     * @param array $options 请求参数[headers,data]
     * @return boolean|string
     */
    public function send($method, $url, $options = [])
    {
        if (PHP_VERSION >= 7.0) {
            $query      = $options['query']??false;
            $headers    = $options['headers']??false;
            $cookie     = $options['cookie']??false;
            $cookieFile = $options['cookie_file']??false;
            $referer    = $options['referer']??false;
        } else {
            $query      = (isset($options['query'])   && !empty($options['query'])) ? $options['query'] : false;
            $headers    = (isset($options['headers']) && !empty($options['headers'])) ? $options['headers'] : false;
            $cookie     = (isset($options['cookie'])  && !empty($options['cookie'])) ? $options['cookie'] : false;
            $cookieFile = (isset($options['cookie_file']) && !empty($options['cookie_file'])) ? $options['cookie_file'] : false;
            $referer    = (isset($options['referer']) && !empty($options['referer'])) ? $options['referer'] : false;
        }
        // GET 参数设置
        if ($query) {
            $url .= (stripos($url, '?') !== false ? '&' : '?') . http_build_query($options['query']);
        }

        // 初始化curl
        $curl = curl_init();

        // 浏览器代理设置
        curl_setopt($curl, CURLOPT_USERAGENT, $this->getUserAgent());

        // CURL 头信息设置
        if ($headers) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $options['headers']);
        }

        // Cookie 信息设置
        if ($cookie) {
            curl_setopt($curl, CURLOPT_COOKIE, $options['cookie']);
        }

        if ($cookieFile) {
            curl_setopt($curl, CURLOPT_COOKIEJAR, $options['cookie_file']);
            curl_setopt($curl, CURLOPT_COOKIEFILE, $options['cookie_file']);
        }

        // 设置referer
        if ($referer) {
            curl_setopt($curl, CURLOPT_REFERER, $options['referer']);
        }

        // POST 数据设置
        if (strtolower($method) === 'post') {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $this->setFormData($options['data']));
            var_dump('HHHHHHHHHHHH',$this->setFormData($options['data']));
        }

        // 请求超时设置
        if (isset($options['timeout']) && is_numeric($options['timeout'])) {
            curl_setopt($curl, CURLOPT_TIMEOUT, $options['timeout']);
        } else {
            curl_setopt($curl, CURLOPT_TIMEOUT, 60);
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_AUTOREFERER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        
        $this->response = curl_exec($curl);
        $this->requestHeaders = curl_getinfo($curl);

        $this->statusCode = $this->requestHeaders['http_code'];

        if ($this->statusCode !== 200) {
            $this->response = false;
        }

        curl_close($curl);

        return $this;
    }

    /**
     * 获取请求头信息
     */
    public function getRequestHeaders()
    {
        return $this->requestHeaders;
    }

    /**
     * 获取状态码
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * 获取响应数据
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * 转数组
     */
    public function toArray()
    {
        if (stripos($this->getResponse(), '<xml>') !== false) {
            return (array)simplexml_load_string($this->getResponse(), 'SimpleXMLElement', LIBXML_NOCDATA);
        } else {
            return json_decode($this->getResponse(), true);
        }
    }

    /**
     * 转json
     */
    public function toJson(bool $flag = false)
    {
        return json_encode($this->toArray(), $flag ? JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT : JSON_UNESCAPED_UNICODE);
    }

    /** 
	 * 数组转xml
	 */
	public function toXml($data, $eIsArray = FALSE)
    {
    	$this->xml = new \XmlWriter();
        if(!$eIsArray) {
            $this->xml->openMemory();
            $this->xml->startDocument('1.0', 'UTF-8');
            $this->xml->startElement('xml');
            $this->xml->startElement('data');
        }

        foreach($data as $key => $item) {
            if(is_array($item)) {
                $this->xml->startElement($key);
                $this->toXml($item, true);
                $this->xml->endElement();
                continue;
            }
            $this->xml->writeElement($key, $item);
        }

        if(!$eIsArray) {
            $this->xml->endElement();
            $this->xml->endElement();
            return $this->xml->outputMemory(true);
        }
    }

    /**
     * POST数据过滤处理
     * @param array $data 需要处理的数据
     * @param boolean $build 是否编译数据
     * @return array|string
     */
    private function setFormData($data, $build = true)
    {
        if (!is_array($data)) return $data;

        foreach ($data as $key => $item) {
            if (is_object($item) && $item instanceof \CURLFile) {
                $build = false;
            } elseif (is_string($item) && class_exists('CURLFile', false) && stripos($item, '@') === 0) {
                if (($filePath = realpath(trim($item, '@'))) && file_exists($filePath)) {
                    list($build, $data[$key]) = [false, new \CURLFile($filePath)];
                }
            }
        }

        return $build ? http_build_query($data) : $data;
    }


    /**
     * 获取浏览器代理信息
     * @return string
     */
    private function getUserAgent()
    {
        if (!empty($_SERVER['HTTP_USER_AGENT'])) return $_SERVER['HTTP_USER_AGENT'];
        $userAgents = [
            "Mozilla/5.0 (Windows NT 6.1; rv:2.0.1) Gecko/20100101 Firefox/4.0.1",
            "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.57 Safari/536.11",
            "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0",
            "Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; .NET4.0C; .NET4.0E; .NET CLR 2.0.50727; .NET CLR 3.0.30729; .NET CLR 3.5.30729; InfoPath.3; rv:11.0) like Gecko",
            "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-us) AppleWebKit/534.50 (KHTML, like Gecko) Version/5.1 Safari/534.50",
            "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)",
            "Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0)",
            "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:2.0.1) Gecko/20100101 Firefox/4.0.1",
            "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_0) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.56 Safari/535.11",
        ];
        return $userAgents[array_rand($userAgents, 1)];
    }
}