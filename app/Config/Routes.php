<?php

use App\Controllers\RegimeController;
use App\Controllers\UserController;
use App\Controllers\AdminController;
use App\Controllers\ActiviteController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('admin', function($routes) {
    $routes->get('/', 'AdminController::loginForm');
    $routes->post('login', 'AdminController::login');
    $routes->post('dashboard', 'AdminController::index');
    $routes->get('create-form', 'ActiviteController::CreationForm');
    $routes->post('create-activity', 'ActiviteController::createActivity');
    $routes->get('activities', 'ActiviteController::index');
    $routes->get('activites/update/(:num)', 'ActiviteController::UpdateForm/$1');
    $routes->post('activites/updated-activity', 'ActiviteController::updateActivity');
    $routes->post('activites/delete/(:num)', 'ActiviteController::deleteActivity/$1');
    
    // Routes pour Régimes
    $routes->get('regime-form', 'RegimeController::CreationForm');
    $routes->post('create-regime', 'RegimeController::createRegime');
    $routes->get('regimes', 'RegimeController::index');
    $routes->get('regimes/update/(:num)', 'RegimeController::UpdateForm/$1');
    $routes->post('regimes/updated-regime', 'RegimeController::updateRegime');
    $routes->post('regimes/delete/(:num)', 'RegimeController::deleteRegime/$1');

    $routes->get('codes', 'AdminController::getInvalidCodes');
    $routes->get('codes/validate/(:num)', 'AdminController::ValidCode/$1');
    $routes->post('codes/refuse/(:num)', 'AdminController::RefusedCode/$1');
});
$routes->get('/', 'Home::index');
$routes->get('/login', 'UserController::loginForm');
$routes->post('/login', 'UserController::login');
$routes->get('/logout', 'UserController::logout');
$routes->get('/register/(:num)', 'UserController::registerForm/$1');
$routes->post('/register/1', 'UserController::registerStep1');
$routes->post('/register/2', 'UserController::registerStep2');
$routes->get('/admin/dashboard', 'AdminController::index');
$routes->get('/objectif', 'ObjectifController::index');
$routes->get('/objectif/create', 'ObjectifUserController::create');
$routes->post('/objectif/store', 'ObjectifUserController::store');

// $routes->get('/objectif/edit/(:num)', 'ObjectifController::edit/$1');
$routes->post('/objectif/update/(:num)', 'ObjectifUserController::update/$1');

$routes->get('/objectif/delete/(:num)', 'ObjectifUserController::delete/$1');

$routes->group('profil', function($routes){

    $routes->get('/', 'ProfilController::index');  
    $routes->post('step1', 'ProfilController::insertProfil');  
    $routes->post('step2', 'ObjectifUserController::store');  
    $routes->get('show', 'ProfilController::profile');

});
$routes->group('regime', function($routes) {
    $routes->get('suggestions', 'RegimeController::suggestions');
    $routes->post('choisir/(:num)', 'RegimeController::choisir/$1');
});
$routes->group('abonnement', function($routes) {
    $routes->get('/', 'AbonnementController::index');
    $routes->post('store', 'AbonnementController::store');
});
