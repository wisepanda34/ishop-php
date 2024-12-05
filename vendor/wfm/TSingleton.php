<?php

namespace wfm;

// Трейт - это механизм повторного использования кода в PHP, 
// который позволяет объединять методы и свойства, 
// которые могут быть использованы в разных классах,
// т.е. трейты определяют композицию поведения в классах, 
// а интерфейсы определяют контракты в классах и обеспечивают типизацию и проверку типов, оставаясь полностью абстрактными
trait TSingleton
{
  private static ?self $instance = null;

  private function __construct() {}

  public static function getInstance(): static
  {
    // обеспечивает создание одного экземпляра класса
    return static::$instance ?? static::$instance = new static();
  }
}
