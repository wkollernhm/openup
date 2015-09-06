<?php
// disable automatic yii error handling, causes the command to stop on error
define('YII_ENABLE_EXCEPTION_HANDLER', false);
define('YII_ENABLE_ERROR_HANDLER', false);

// change the following paths if necessary
$yiic=dirname(__FILE__).'/../framework/yiic.php';
$config=dirname(__FILE__).'/config/main.php';

require_once($yiic);
