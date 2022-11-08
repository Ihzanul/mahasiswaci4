<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('layout');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Layout::index');
$routes->get('/layout', 'Layout::index',  ['filter' => 'ceklogin']);
$routes->get('mahasiswa', 'Mahasiswa::index', ['filter' => 'ceklogin']);
// $routes->get('mahasiswa/(:any)', 'Mahasiswa::$1', ['filter' => 'ceklogin']);
$routes->get('mahasiswa/ambildata', 'Mahasiswa::ambildata');
$routes->get('mahasiswa/formtambah', 'Mahasiswa::formtambah');
$routes->post('mahasiswa/simpandata', 'Mahasiswa::simpandata');
$routes->post('mahasiswa/formedit', 'Mahasiswa::formedit');
$routes->post('mahasiswa/updatedata', 'Mahasiswa::updatedata');
$routes->post('mahasiswa/hapus', 'Mahasiswa::hapus');
$routes->get('mahasiswa/formtambahbanyak', 'Mahasiswa::formtambahbanyak');
$routes->post('mahasiswa/simpandatabanyak', 'Mahasiswa::simpandatabanyak');
$routes->post('mahasiswa/hapusbanyak', 'Mahasiswa::hapusbanyak');
$routes->post('mahasiswa/listdata', 'Mahasiswa::listdata');
$routes->post('mahasiswa/formupload', 'Mahasiswa::formupload');
$routes->post('mahasiswa/doupload', 'Mahasiswa::doupload');
$routes->get('login', 'Login::index');
// $routes->get('test', 'Login::test');
$routes->post('cekuser', 'Login::cekuser');
$routes->get('keluar', 'Login::keluar');

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
