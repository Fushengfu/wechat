<?php

namespace Fushengfu\Wechat;

/**
 * 工厂类
 */
class Factory {
  /**
   * @param string $name
   */
  public static function make($namespace, array $config)
  {
    $application = "\\Fushengfu\\Wechat\\{$namespace}\\Application";

    return new $application($config);
  }

  /**
   * Dynamically pass methods to the application.
   *
   * @param string $name
   * @param array  $arguments
   *
   * @return mixed
   */
  public static function __callStatic($name, $arguments)
  {
    return self::make($name, ...$arguments);
  }
}