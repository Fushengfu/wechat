<?php
namespace Fushengfu\Wechat;
/**
 * 缓存类
 */
use Fushengfu\Wechat\cache\driver\File;

class Cache extends File {
    /**
     * 架构函数
     * @param array $options 参数
     */
    public function __construct($options = [])
    {
        if (!empty($options)) {
            $this->options = array_merge($this->options, $options);
        }

        if (empty($this->options['path'])) {
            $this->options['path'] = '/tmp/cache';
        }

        if (substr($this->options['path'], -1) != DIRECTORY_SEPARATOR) {
            $this->options['path'] .= DIRECTORY_SEPARATOR;
        }
    }
}