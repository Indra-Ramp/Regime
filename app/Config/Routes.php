<?php

use App\Controllers\RegimeController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('admin', function($routes) {
    $routes->get('regime', 'RegimeController::index');
    $routes->post('regime/save', 'RegimeController::insertRegime');
});
$routes->get('/', 'Home::index');
$routes->get('/login', 'UserController::loginForm');
$routes->get('/register/(:num)', 'UserController::registerForm/$1');
$routes->post('/register/1', 'UserController::registerStep1');
<<<<<<< HEAD
$routes->get('/admin/dashboard', 'AdminController::index');
=======
$routes->get('/objectif', 'ObjectifController::index');
$routes->get('/objectif/create', 'ObjectifUserController::create');
$routes->post('/objectif/store', 'ObjectifUserController::store');

// $routes->get('/objectif/edit/(:num)', 'ObjectifController::edit/$1');
$routes->post('/objectif/update/(:num)', 'ObjectifUserController::update/$1');

$routes->get('/objectif/delete/(:num)', 'ObjectifUserController::delete/$1');

$routes->group('profil', function($routes){

    $routes->get('/', 'ProfilController::index');

    $routes->post('create', 'ProfilController::insertProfil');

    $routes->get('show', 'ProfilController::profile');

});
>>>>>>> 03aa73ce7ee91e33483329b2bd61e266c88e504d
