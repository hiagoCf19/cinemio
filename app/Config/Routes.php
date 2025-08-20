<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Web
$routes->get('/', 'landing\LandingPageController::index');
$routes->get('/testDb', 'TestDb::index');
$routes->get('/landing', 'landing\LandingPageController::index');
$routes->get('/login', 'Auth\LoginController::index');
$routes->post('/login', 'Auth\LoginController::login');
$routes->get('/cadastro', 'Auth\RegisterController::index');
$routes->post('/register', 'Auth\RegisterController::register');

// processa o form

// API
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->post('login', 'LoginApiController::login'); // POST /api/login
});
