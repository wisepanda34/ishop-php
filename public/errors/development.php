<?php

/**
 * @var $errno \wfm\ErrorHandler
 * @var $errstr \wfm\ErrorHandler
 * @var $errfile \wfm\ErrorHandler
 * @var $errline \wfm\ErrorHandler
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP</title>
</head>

<body>
  <h1>Error happened</h1>
  <p><b>Error code:</b><?= $errno ?></p>
  <p><b>Error message:</b><?= $errstr ?></p>
  <p><b>Error file:</b><?= $errfile ?></p>
  <p><b>Error line:</b><?= $errline ?></p>
</body>

</html>