<?php 
require_once('app/utils/Router.php');

$router = new Router();

$router->get('/', 'app/controllers/HomeController.php', 'show');
$router->get('/friend/{id}', 'app/controllers/FriendController.php', 'show');




//API routes
$router->get('/api/products', 'app/controllers/api/GetProductsController.php', 'getProducts');
// $router->get('/api/categories', 'app/controllers/api/GetCategoriesController.php', 'useGetCategories');

