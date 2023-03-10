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
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override(function ($message = null) {
    if ($_SERVER['CI_ENVIRONMENT'] == 'production') {
        $message = 'Kemungkinan halaman telah dihapus, atau Anda salah menulis URL.';
    }
    helper(['app', 'auth']);
    return view('errors/error404', ['title' => 'Error 404', 'appIdentity' => appIdentity(), 'message' => $message]);
});
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$db = \Config\Database::connect();
$builder = $db->table('app_routes');
$output = $builder->orderBy('route_order', 'ASC')->get()->getResultArray();
foreach ($output as $out) {
    $optionKeys = explode(';', $out['route_option_keys']);
    $optionValues = explode(';', $out['route_option_values']);
    $options = array_combine($optionKeys, $optionValues);
    if ($out['route_request'] == 'get') {
        if ($out['route_options'] == 0) {
            $routes->get($out['route_from'], $out['route_to']);
        } else {
            $routes->get($out['route_from'], $out['route_to'], $options);
        }
    } else if ($out['route_request'] == 'post') {
        if ($out['route_options'] == 0) {
            $routes->post($out['route_from'], $out['route_to']);
        } else {
            $routes->post($out['route_from'], $out['route_to'], $options);
        }
    }
}

service('auth')->routes($routes);

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
