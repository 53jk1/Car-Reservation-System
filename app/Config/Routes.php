<?php namespace Config;

// Domyślne ustawienia frameworka
$routes = Services::routes();

if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('App');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(true);
$routes->set404Override();
$routes->setAutoRoute(true);

// ********************************************************************
// Tablica routingu
// ustawiane ręcznie
// ********************************************************************

// Strona główna
	$routes->get('/', 'App::index');	// GET, Strona główna

// Obsługa administracyjna
	$routes->get('login', 'App::login_page');		// GET, Strona logowania
	$routes->post('/login', 'App::login_process');	// POST, Logika logowania
	$routes->get('/logout', 'App::logout');			// GET, Logika wylogowania
	$routes->get('/admin', 'App::admin');			// GET, Strona administracyjna
	$routes->post('/admin', 'App::admin_edit');		// POST, Strona administracyjna, logika zmian

// Obsługa pojazdów
	$routes->get('/car/(:num)', 'App::samochod/$1');		// GET, Strona główna
	$routes->post('/wypozycz', 'App::samochod_process');	// Strona główna


/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
