<?php

session_start();

require '../src/config/config.php';
require '../vendor/autoload.php';
require SRC . 'helper.php';

$router = new Project\Router($_SERVER["REQUEST_URI"]);
// HOMEPAGE
$router->get('/', "UserController@index");

// USER PAGE
$router->get('/register/', "UserController@showRegister");
$router->get('/login/', "UserController@showLogin");
$router->post('/register/', "UserController@register");
$router->post('/login/', "UserController@login");
$router->get('/logout/', "UserController@logout");

$router->run();
