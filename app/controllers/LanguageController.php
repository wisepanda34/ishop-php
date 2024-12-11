<?php

namespace app\controllers;

use wfm\App;

//менять язык приложения 
class LanguageController extends AppController
{
  public function changeAction()
  {
    // $lang = $_GET['lang'] ?? null;
    $lang = get('lang', 's'); // get - хелпер
    if ($lang) {
      if (array_key_exists($lang, App::$app->getProperty('languages'))) {
        //отрезаем базовый URL
        $referer = $_SERVER['HTTP_REFERER'] ?? '';
        $url = trim(str_replace(PATH, '', $referer), '/');

        //разбиваем на 2 части... 1-я часть - возможный бывший язык
        $url_parts = explode('/', $url, 2);

        //ищем первую часть (бывший язык) в массиве языков
        if (array_key_exists($url_parts[0], App::$app->getProperty('languages'))) {
          //присваеваем первой части код нового языка, если он не является базовым
          if ($lang != App::$app->getProperty('language')['code']) {
            $url_parts[0] = $lang;
          } else {
            //если это базовый язык - удалим язык из url
            array_shift($url_parts);
          }
        } else {
          //присваиваем первой части новый язык, если он не является базовым
          if ($lang != App::$app->getProperty('language')['code']) {
            //добавляем в начало массива код языка $lang
            array_unshift($url_parts, $lang);
          }
        }
        //собираем URL
        $url = PATH . '/' . implode('/', $url_parts);
        redirect($url);
      }
    }
    //если пользователь в URL добавил несуществующий в массиве языков язык, то происходит простой редирект на ту же страницу
    redirect();
  }
}
