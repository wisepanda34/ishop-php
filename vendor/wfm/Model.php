<?php

namespace wfm;

abstract class Model
{

  public array $attributes = []; //свойство для указания какие данные мы будем получать от юзера, например из формы;
  public array $errors = [];
  public array $rules = []; //правила валидации
  public array $labels = []; //для реализации мультиязычности

  public function __construct()
  {
    Db::getInstance();
  }
}
