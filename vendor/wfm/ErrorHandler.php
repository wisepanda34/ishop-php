<?php

namespace wfm;

class ErrorHandler
{
  public function __construct()
  {
    // https://habr.com/ru/post/161483
    if (DEBUG) {
      error_reporting(-1);
    } else {
      error_reporting(0);
    }

    set_exception_handler([$this, 'exceptionHandler']); //при возникновении неперехваченных исключений
    set_error_handler([$this, 'errorHandler']); //при возникновении различных типов ошибок, таких как предупреждения, уведомления и т.д.
    ob_start(); //включение буферизации
    register_shutdown_function([$this, 'fatalErrorHandler']); //обрабатывает фатальные ошибки, которые не могут быть перехвачены обычными обработчиками ошибок или исключений.
  }

  public function errorHandler($errno, $errstr, $errfile, $errline)
  {
    $this->logError($errstr, $errfile, $errline);
    $this->displayError($errno, $errstr, $errfile, $errline);
  }

  public function fatalErrorHandler()
  {
    $error = error_get_last();
    if (!empty($error) && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
      $this->logError($error['message'], $error['file'], $error['line']);
      ob_end_clean();
      $this->displayError($error['type'], $error['message'], $error['file'], $error['line']);
      ob_end_flush();
    }
  }

  public function exceptionHandler(\Throwable $e)
  {
    $this->logError($e->getMessage(), $e->getFile(), $e->getLine());
    $this->displayError('exception', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
  }

  public function logError($message = '', $file = '', $line = '')
  {
    //ErrorLog
    file_put_contents(
      LOGS . '/errors.log',
      "[" . date('Y-m-d H:i:s') . "] Text message: {$message} | File: {$file} | Line: {$line}\n=============\n",
      FILE_APPEND
    );
  }

  public function displayError($errno, $errstr, $errfile, $errline, $response = 500)
  {
    if ($response == 0) {
      $response = 404;
    }

    http_response_code($response);

    if ($response == 404 && !DEBUG) {
      require_once WWW . '/errors/404.php';
      die;
    }
    if (DEBUG) {
      require_once WWW . '/errors/development.php';
    } else {
      require_once WWW . '/errors/production.php';
    }
    die;
  }
}
