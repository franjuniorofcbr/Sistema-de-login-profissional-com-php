<?php

use App\Core\Router;

$router = new Router();

// Auth routes
$router->get('/', 'AuthController@loginForm');
$router->post('/login', 'AuthController@login');
$router->get('/dashboard', 'AuthController@dashboard');
$router->get('/logout', 'AuthController@logout');

$router->dispatch();
