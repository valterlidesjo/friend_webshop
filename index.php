<?php
require_once('./router.php');
require_once('./vendor/autoload.php');
require_once('./app/utils/PathFunction.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$base_uri = dirname($_SERVER['SCRIPT_NAME']); // Hämtar base URI automatiskt
$uri = str_replace($base_uri, '', $_SERVER['REQUEST_URI']); // Tar bort base URI från request

$uri = rtrim($uri, '/') ?: '/';

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);
