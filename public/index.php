<?php

session_start();

require '../src/config/config.php';
require '../vendor/autoload.php';
require SRC . 'helper.php';

$router = new Project\Router($_SERVER["REQUEST_URI"]);
// HOMEPAGE
$router->get('/', "ViewController@showHome");

// USER
// - login
$router->get('/login/', "ViewController@showLogin");
$router->post('/login/', "UserController@login");

// - register
$router->get('/register/', "ViewController@showRegister");
$router->post('/register/', "UserController@register");

// - logout
$router->get('/logout/', "UserController@logout");

$router->run();
