<?php

namespace app\widgets\language;

use RedBeanPHP\R;
use wfm\App;

class Language
{
  protected $tpl;
  protected array $languages; // массив возможных языков из БД
  protected $language; // текущий язык

  public function __construct()
  {
    $this->tpl = __DIR__ . '/lang_tpl.php'; //путь к шаблону переключателя языков, т.е. html код переключателя
    $this->run();
    echo $this->getHtml();
  }

  protected function run()
  {
    $this->languages = App::$app->getProperty('languages');
    $this->language = App::$app->getProperty('language');
  }

  public static function getLanguages(): array
  {
    return R::getAssoc("SELECT code, title, base, id  FROM `language` ORDER BY base DESC");
  }

  //этот метод возвращает активный язык
  public static function getLanguage($languages)
  {
    $lang = App::$app->getProperty('lang');

    if ($lang && array_key_exists($lang, $languages)) // проверяем существует ли язык $lang в глобальных свойствах и состоит ли он в массиве доступных языков из БД 
    {
      $key = $lang;
    } elseif (!$lang) { // если переменная $lang пустая, то берем язык  по умолчанию из БД
      if (empty($languages)) {
        throw new \Exception("Language array is empty", 500);
      }
      $key = key($languages);
    } else {
      $lang = h($lang);
      throw new \Exception("Not found language {$lang}", 404); // если такой язык не поддерживается, то выбрасываем исключение 
    }
    $lang_info = $languages[$key];
    $lang_info['code'] = $key;
    return $lang_info;
  }

  protected function getHtml(): string
  {
    ob_start();
    require_once $this->tpl;
    return ob_get_clean();
  }
}
