<?php 
require_once('app/utils/Router.php');

$router = new Router();

$router->get('/', 'app/controllers/HomeController.php', 'show');
$router->get('/test', 'app/controllers/TestController.php', 'show');