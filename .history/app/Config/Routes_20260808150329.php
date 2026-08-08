<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', function () {
    if (session()->get('logged_in')) {
        return redirect()->to('/dashboard');
    }

    return redirect()->to('/login');
});

// =========================
// WEB ROUTES
// =========================

$routes->get('register', 'WebAuth::register');
$routes->post('register', 'WebAuth::registerProcess');

$routes->get('login', 'WebAuth::login');
$routes->post('login', 'WebAuth::loginProcess');
$routes->get('logout', 'WebAuth::logout');

$routes->get('dashboard', 'Dashboard::index');
$routes->get('test/hash', 'Test::hash');

// Buku
$routes->get('buku', 'Buku::web');
$routes->get('buku/tambah', 'Buku::createWeb');
$routes->post('buku/tambah', 'Buku::storeWeb');
$routes->get('buku/edit/(:num)', 'Buku::editWeb/$1');
$routes->post('buku/edit/(:num)', 'Buku::updateWeb/$1');
$routes->get('buku/hapus/(:num)', 'Buku::deleteWeb/$1');

// Kategori
$routes->get('kategori', 'Kategori::web');
$routes->get('kategori/tambah', 'Kategori::createWeb');
$routes->post('kategori/tambah', 'Kategori::storeWeb');
$routes->get('kategori/edit/(:num)', 'Kategori::editWeb/$1');
$routes->post('kategori/edit/(:num)', 'Kategori::updateWeb/$1');
$routes->get('kategori/hapus/(:num)', 'Kategori::deleteWeb/$1');

// Anggota
$routes->get('anggota', 'Anggota::web');
$routes->get('anggota/tambah', 'Anggota::createWeb');
$routes->post('anggota/tambah', 'Anggota::storeWeb');
$routes->get('anggota/edit/(:num)', 'Anggota::editWeb/$1');
$routes->post('anggota/edit/(:num)', 'Anggota::updateWeb/$1');
$routes->get('anggota/hapus/(:num)', 'Anggota::deleteWeb/$1');

// Peminjaman
$routes->get('peminjaman', 'Peminjaman::web');
$routes->get('peminjaman/pinjam/(:num)', 'Peminjaman::pinjamWeb/$1');
$routes->get('peminjaman/validasi/(:num)', 'Peminjaman::validasiPengembalianWeb/$1');

// Riwayat Anggota
$routes->get('riwayat', 'Peminjaman::riwayatWeb');
$routes->get('riwayat/ajukan/(:num)', 'Peminjaman::ajukanPengembalianWeb/$1');

$routes->group('api', function($routes){
    $routes->post('register','Auth::register');
    $routes->post('login','Auth::login');
    $routes->get
});