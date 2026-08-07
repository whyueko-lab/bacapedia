<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->group('api', function($routes){
    $routes->post('register','Auth::register');
    $routes->post('login','Auth::login');
});

$routes->group('api', ['filter' => 'auth'], function($routes){

    $routes->get('profile','Auth::profile');

});

