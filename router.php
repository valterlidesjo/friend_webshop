<?php
require_once('app/utils/Router.php');

$router = new Router();

$router->get('/', 'app/controllers/HomeController.php', 'show');
$router->get('/friend', 'app/controllers/FriendController.php', 'show');
$router->get('/products', 'app/controllers/ProductsController.php', 'show');
$router->get('/register', 'app/controllers/RegisterController.php', 'show');
$router->get('/login', 'app/controllers/LoginController.php', 'show');
$router->get('/checkout', 'app/controllers/CheckoutController.php', 'show');
$router->get('/confirmation', 'app/controllers/ConfirmationController.php', 'show');
