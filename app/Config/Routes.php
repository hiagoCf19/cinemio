<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Web
$routes->get('/', 'LoginWebController::index');          // carrega a view de login
$routes->post('/login', 'LoginWebController::loginWeb');    // processa o form

// API
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->post('login', 'LoginApiController::login'); // POST /api/login
});



