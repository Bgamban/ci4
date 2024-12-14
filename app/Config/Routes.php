<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);
$routes->set404Override();
$routes->get('/', 'Pages::index');

$routes->get('pages', 'pages::index');

$routes->get('/anime/create', 'Anime::create');
$routes->get('/anime/edit/(:segment)', 'Anime::edit/$1');
$routes->delete('/anime/(:num)', 'Anime::delete/$1');
$routes->get('/anime/(:any)', 'Anime::detail/$1');
