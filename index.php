<?php 
require_once('./router.php');
// require $_SERVER['DOCUMENT_ROOT'] . '/webbshop-uppgift/app/utils/PathFunction.php';
require_once('./app/utils/PathFunction.php');

$base_uri = dirname($_SERVER['SCRIPT_NAME']); // Hämtar base URI automatiskt
$uri = str_replace($base_uri, '', $_SERVER['REQUEST_URI']); // Tar bort base URI från request

$uri = rtrim($uri, '/') ?: '/';

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);