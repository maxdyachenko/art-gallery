<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();

// Подключение файлов системы
define('ROOT', dirname(__FILE__));

require_once(ROOT.'/components/Router.php');

$router = new Router();
$router->run();

