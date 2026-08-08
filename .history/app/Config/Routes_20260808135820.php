<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', function () {
    if (session()->get('logged_in')) {
        return redirect()->to('/dashboard');
    }

    return redirect()->to('/login');
});

$routes->get('register', 'WebAuth::register');
$routes->post('register', 'WebAuth::registerProcess');

$routes->get('buku', 'Buku::web');
$routes->get('peminjaman/pinjam/(:num)', 'Peminjaman::pinjamWeb/$1');
$routes->get('riwayat', 'Peminjaman::web');

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
    $routes->get('profile', 'Auth::profile');
    $routes->get('kategori', 'Kategori::index');
    $routes->get('buku', 'Buku::index');

    // Anggota hanya melihat riwayat
    $routes->get('peminjaman', 'Peminjaman::index');
     // Anggota bisa meminjam buku
    $routes->post('peminjaman', 'Peminjaman::pinjam');
});

$routes->group('api', ['filter' => 'staff'], function($routes){
    // Diproses oleh Admin/Petugas
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
     $routes->put('peminjaman/(:num)/kembalikan', 'Peminjaman::kembalikan/$1');

     // Laporan peminjaman
    $routes->get('laporan/peminjaman', 'Peminjaman::laporan');
    $routes->put('peminjaman/(:num)/sampling-terlambat', 'Peminjaman::samplingTerlambat/$1');
});

$routes->group('api', ['filter' => 'auth'], function ($routes) {
    $routes->get('buku', 'Buku::index');
    // Kategori (Web)
    $routes->get('kategori', 'Kategori::web');
    $routes->get('kategori/tambah', 'Kategori::createWeb');
    $routes->post('kategori/tambah', 'Kategori::storeWeb');
    $routes->get('kategori/edit/(:num)', 'Kategori::editWeb/$1');
    $routes->post('kategori/edit/(:num)', 'Kategori::updateWeb/$1');
    $routes->get('kategori/hapus/(:num)', 'Kategori::deleteWeb/$1');
});