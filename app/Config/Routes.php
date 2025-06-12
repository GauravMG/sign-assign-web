<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/admin/blogs/update/(:any)', 'AdminController::updateBlog/$1');
$routes->get('/admin/blogs/add', 'AdminController::addBlog');
$routes->get('/admin/blogs/(:any)', 'AdminController::viewBlog/$1');
$routes->get('/admin/blogs', 'AdminController::blogs');

$routes->get('/admin/invoices/print', 'AdminController::invoicePrint');
$routes->get('/admin/invoices', 'AdminController::invoices');

// $routes->get('/admin/variant-media/add/(:any)', 'AdminController::addVariantMedia/$1');

// $routes->get('/admin/variants/view/(:any)', 'AdminController::viewVariant/$1');

$routes->get('/admin/products/update/(:any)', 'AdminController::updateProduct/$1');
$routes->get('/admin/products/add', 'AdminController::addProduct');
$routes->get('/admin/products/(:any)', 'AdminController::viewProduct/$1');
$routes->get('/admin/products', 'AdminController::products');

$routes->get('/admin/product-subcategories/view/(:any)', 'AdminController::viewProductSubCategory/$1');
$routes->get('/admin/product-subcategories/update/(:any)', 'AdminController::updateProductSubCategory/$1');
$routes->get('/admin/product-subcategories/add/(:any)', 'AdminController::addProductSubCategory/$1');

$routes->get('/admin/product-categories/view/(:any)', 'AdminController::viewProductCategory/$1');
$routes->get('/admin/product-categories/update/(:any)', 'AdminController::updateProductCategory/$1');
$routes->get('/admin/product-categories/add', 'AdminController::addProductCategory');
$routes->get('/admin/product-categories', 'AdminController::productCategories');

$routes->get('/admin/attributes', 'AdminController::attributes');

$routes->get('/admin/banners/add', 'AdminController::addBanner');
$routes->get('/admin/banners', 'AdminController::banners');

$routes->get('/admin/support-tickets/(:any)', 'AdminController::viewSupportTicket/$1');
$routes->get('/admin/support-tickets', 'AdminController::supportTickets');

$routes->get('/admin/users/update/(:any)', 'AdminController::updateUser/$1');
$routes->get('/admin/users/add', 'AdminController::addUser');
$routes->get('/admin/users/(:any)', 'AdminController::viewUser/$1');
$routes->get('/admin/users', 'AdminController::users');

$routes->get('/admin/forgot-password', 'AuthController::forgotPassword');
// $routes->get('/admin/register', 'AuthController::register');
$routes->get('/admin/login', 'AuthController::login');
$routes->get('/admin', 'AuthController::login');

$routes->get('/learning-center/(:any)', 'WebController::blogDetail/$1');
$routes->get('/learning-center', 'WebController::blogs');
$routes->get('/checkout', 'WebController::checkout');
$routes->get('/product/(:any)', 'WebController::productDetail/$1');
$routes->get('/subcategory/(:any)', 'WebController::productSubCategory/$1');
$routes->get('/category/(:any)', 'WebController::productCategory/$1');
$routes->get('/about-us', 'WebController::aboutUs');
$routes->get('/', 'WebController::index');
