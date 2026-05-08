<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'UserController::loginForm');
$routes->get('/register/(:num)', 'UserController::registerForm/$1');
