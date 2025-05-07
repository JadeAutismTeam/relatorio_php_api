<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('swagger', 'Swagger::index');
$routes->get('swagger-ui', 'Swagger::ui');

$routes->group('v2/relatorio-toque', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->post('(:segment)/sincronizar', 'RelatorioToque::sincronizar/$1');
    $routes->post('(:segment)/sincronizar/massa', 'RelatorioToque::sincronizarMassa/$1');
});
