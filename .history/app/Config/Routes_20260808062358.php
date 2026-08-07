<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('dashboard', 'Dashboard::index');
$routes->get('test/hash', 'Test::hash');

$routes->get('login', 'WebAuth::login');
$routes->post('login', 'WebAuth::loginProcess');
$routes->get('logout', 'WebAuth::logout');

$routes->group('api', function($routes){
    $routes->post('register','Auth::register');
    $routes->post('login','Auth::login');
});

$routes->group('api', ['filter' => 'auth'], function($routes){
    $routes->get('profile','Auth::profile');
    $routes->get('kategori', 'Kategori::index');
    $routes->get('buku', 'Buku::index');

    $routes->get('peminjaman', 'Peminjaman::index');

    $routes->post('peminjaman', 'Peminjaman::pinjam');
    $routes->put('peminjaman/(:num)/kembalikan', 'Peminjaman::kembalikan/$1');
});

$routes->group('api', ['filter' => 'admin'], function($routes){
    $routes->post('kategori', 'Kategori::create');
    $routes->put('kategori/(:num)', 'Kategori::update/$1');
    $routes->delete('kategori/(:num)', 'Kategori::delete/$1');
    $routes->post('buku', 'Buku::create');
    $routes->put('buku/(:num)', 'Buku::update/$1');
    $routes->delete('buku/(:num)', 'Buku::delete/$1');
});

$routes->group('api', ['filter' => 'auth'], function ($routes) {
    $routes->get('buku', 'Buku::index');
});