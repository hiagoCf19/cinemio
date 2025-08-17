<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Web
$routes->get('/landing', 'landing\LandingPageController::index');
$routes->post('/auth', 'LoginController::index');    // processa o form

// API
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->post('login', 'LoginApiController::login'); // POST /api/login
});