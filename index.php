<?php
header('Content-Type:text/html;Charset=utf-8');

define("ROOT_PATH", realpath(dirname(__FILE__)) . "/" );

require ROOT_PATH . "vendor/autoload.php";

$app = require ROOT_PATH . "system/App.php";

$app->execute();
