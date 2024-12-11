<?php


function debug($data, $die = false)
{
  echo '<pre>';

  // Определяем тип данных и выводим соответствующим образом
  if (is_array($data)) {
    // Для массивов и объектов используем var_dump для более подробного вывода
    print_r($data);
  } elseif (is_object($data)) {
    var_dump($data);
  } else {
    // Для строк, чисел и других типов выводим через echo
    echo $data;
  }

  echo '</pre>';

  if ($die) {
    die; // Завершаем выполнение, если $die true
  }
}


function h($str)
{
  return htmlspecialchars($str);
}

function redirect($http = false)
{
  if ($http) {
    $redirect = $http;
  } else {
    $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
  }
  header("location: $redirect");
  die;
}

function base_url()
{
  return PATH . '/' . (\wfm\App::$app->getProperty('lang') ? \wfm\App::$app->getProperty('lang') . '/' : '');
}
