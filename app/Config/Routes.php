<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/admin/product-categories/update/(:any)', 'AdminController::updateProductCategory/$1');
$routes->get('/admin/product-categories/add', 'AdminController::addProductCategory');
$routes->get('/admin/product-categories', 'AdminController::productCategories');

$routes->get('/admin/users/update/(:any)', 'AdminController::updateUser/$1');
$routes->get('/admin/users/add', 'AdminController::addUser');
$routes->get('/admin/users/(:any)', 'AdminController::userDetails/$1');
$routes->get('/admin/users', 'AdminController::users');

$routes->get('/admin/forgot-password', 'AuthController::forgotPassword');
// $routes->get('/admin/register', 'AuthController::register');
$routes->get('/admin/login', 'AuthController::login');

$routes->get('/admin', 'AuthController::login');
$routes->get('/', 'AuthController::login');
// $routes->get('/', 'WebController::index');
