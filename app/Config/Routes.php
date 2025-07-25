<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/admin/templates', 'AdminController::templates');

$routes->get('/admin/blogs/update/(:any)', 'AdminController::updateBlog/$1');
$routes->get('/admin/blogs/add', 'AdminController::addBlog');
$routes->get('/admin/blogs/(:any)', 'AdminController::viewBlog/$1');
$routes->get('/admin/blogs', 'AdminController::blogs');

// $routes->get('/admin/invoices/print', 'AdminController::invoicePrint');
$routes->get('/admin/invoices/(:any)', 'AdminController::viewInvoice/$1');

$routes->get('/admin/orders/(:any)', 'AdminController::viewOrder/$1');
$routes->get('/admin/orders', 'AdminController::orders');

// $routes->get('/admin/variant-media/add/(:any)', 'AdminController::addVariantMedia/$1');

// $routes->get('/admin/variants/view/(:any)', 'AdminController::viewVariant/$1');

$routes->get('/admin/rush-charges', 'AdminController::rushCharges');

$routes->get('/admin/products/update/(:any)', 'AdminController::updateProduct/$1');
$routes->get('/admin/products/add', 'AdminController::addProduct');
$routes->get('/admin/products/(:any)/manage-discount', 'AdminController::manageProductDiscount/$1');
$routes->get('/admin/products/(:any)/manage-faq', 'AdminController::manageProductFAQ/$1');
$routes->get('/admin/products/(:any)/manage-attribute', 'AdminController::manageProductAttribute/$1');
$routes->get('/admin/products/(:any)/manage-media', 'AdminController::manageProductMedia/$1');
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

$routes->get('/admin/staff/update/(:any)', 'AdminController::updateStaff/$1');
$routes->get('/admin/staff/add', 'AdminController::addStaff');
$routes->get('/admin/staff/(:any)', 'AdminController::viewStaff/$1');
$routes->get('/admin/staff', 'AdminController::staff');

$routes->get('/admin/customers/update/(:any)', 'AdminController::updateCustomer/$1');
$routes->get('/admin/customers/add', 'AdminController::addCustomer');
$routes->get('/admin/customers/(:any)', 'AdminController::viewCustomer/$1');
$routes->get('/admin/customers', 'AdminController::customers');

$routes->get('/admin/coupons', 'AdminController::coupons');

$routes->get('/admin/forgot-password', 'AuthController::forgotPassword');
// $routes->get('/admin/register', 'AuthController::register');
$routes->get('/admin/login', 'AuthController::login');
$routes->get('/admin', 'AuthController::login');

// $routes->get('/shared/header', 'SharedController::header');
// $routes->get('/shared/footer', 'SharedController::footer');
// $routes->group('shared', ['filter' => 'cors'], function ($routes) {
//     $routes->get('header', 'SharedController::header');
//     $routes->get('footer', 'SharedController::footer');
// });

$routes->get('/payment-success', 'WebController::paymentSuccess');
$routes->get('/learning-center/(:any)', 'WebController::blogDetail/$1');
$routes->get('/learning-center', 'WebController::blogs');
$routes->get('/checkout-update', 'WebController::checkoutUpdate');
$routes->get('/checkout', 'WebController::checkout');
$routes->get('/product/(:any)', 'WebController::productDetail/$1');
$routes->get('/subcategory/(:any)', 'WebController::productSubCategory/$1');
$routes->get('/category/(:any)', 'WebController::productCategory/$1');
$routes->get('/search', 'WebController::search');
$routes->get('/about-us', 'WebController::aboutUs');
$routes->get('/contact-us', 'WebController::contactUs');
$routes->get('/services/(:any)', 'WebController::serviceDetail/$1');
$routes->get('/services', 'WebController::services');
$routes->get('/terms-of-use', 'WebController::termsOfUse');
$routes->get('/privacy-policy', 'WebController::privacyPolicy');
$routes->get('/', 'WebController::index');