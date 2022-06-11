<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/',  function () {
    return view('login');
});

$routes->get('/403',  function () {
    return view('access_denied');
});

$routes->match(['get', 'post'], 'login', 'UserController::login', ['filter' => 'noauth']);

// Admin routes
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'AdminController::index');

    $routes->group('transactions', function ($routes) {
        $routes->get('/', 'Admin/TransactionController::index');
        $routes->get('create', 'Admin/TransactionController::create');
        $routes->post('store', 'Admin/TransactionController::store');
    });

    $routes->group('item-transactions', function ($routes) {
        $routes->post('store', 'Admin/ItemTransactionController::store');
        $routes->post('delete', 'Admin/ItemTransactionController::delete');
    });
});

// Super Admin routes
$routes->group('super_admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'SuperAdminController::index');

    $routes->group('users', function ($routes) {
        $routes->get('/', 'SuperAdmin/UserController::index');
        $routes->get('create', 'SuperAdmin/UserController::create');
        $routes->post('store', 'SuperAdmin/UserController::store');
        $routes->post('update', 'SuperAdmin/UserController::update');
        $routes->post('delete', 'SuperAdmin/UserController::delete');
    });

    $routes->group('transactions', function ($routes) {
        $routes->get('/', 'SuperAdmin/TransactionController::index');
        $routes->get('create', 'SuperAdmin/TransactionController::create');
        $routes->post('store', 'SuperAdmin/TransactionController::store');
    });

    $routes->group('item-transactions', function ($routes) {
        $routes->post('store', 'SuperAdmin/ItemTransactionController::store');
        $routes->post('delete', 'SuperAdmin/ItemTransactionController::delete');
    });

    $routes->group('reports', function ($routes) {
        $routes->get('/', 'SuperAdmin/ReportController::index');
    });

    $routes->group('mahasiswa', function ($routes) {
        $routes->get('/', 'SuperAdmin/MahasiswaController::index');
        $routes->get('create', 'SuperAdmin/MahasiswaController::create');
        $routes->post('store', 'SuperAdmin/MahasiswaController::store');
        $routes->post('update', 'SuperAdmin/MahasiswaController::update');
        $routes->post('delete', 'SuperAdmin/MahasiswaController::delete');
        $routes->post('viewpdf', 'SuperAdmin/MahasiswaController::viewpdf');
        $routes->get('exportpdf', 'SuperAdmin/MahasiswaController::exportpdf');
        $routes->get('exportexcel', 'SuperAdmin/MahasiswaController::exportexcel');
    });
});

// Admin routes
$routes->group('user', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'ConsumerController::index');

    $routes->group('reports', function ($routes) {
        $routes->get('/', 'Consumer/ReportController::index');
    });
});

$routes->get('logout', 'UserController::logout');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
