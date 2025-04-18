<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/users/(:any)', 'AdminController::userDetails/$1');
$routes->get('/users/add', 'AdminController::addUser');
$routes->get('/users', 'AdminController::users');

$routes->get('/forgot-password', 'AuthController::forgotPassword');
$routes->get('/register', 'AuthController::register');
$routes->get('/login', 'AuthController::login');

$routes->get('/', 'AuthController::login');
// $routes->get('/', 'WebController::index');
