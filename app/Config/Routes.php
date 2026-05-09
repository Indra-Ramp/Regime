<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'UserController::loginForm');
$routes->post('/login', 'UserController::login');
$routes->get('/logout', 'UserController::logout');
$routes->get('/register/(:num)', 'UserController::registerForm/$1');
$routes->post('/register/1', 'UserController::registerStep1');
$routes->post('/register/2', 'UserController::registerStep2');