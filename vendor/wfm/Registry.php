<?php

namespace wfm;

// это глобальный реестр (контейнер с настройками, регистр), где можно хранить различные значения 
// и получать к ним доступ из любой части приложения.
class Registry
{
  use TSingleton;

  protected static array $properties = [];

  public function setProperty($name, $value)
  {
    self::$properties[$name] = $value;
  }

  public function getProperty($name)
  {
    return self::$properties[$name] ?? null;
  }

  public function getProperties(): array
  {
    return self::$properties;
  }
}
