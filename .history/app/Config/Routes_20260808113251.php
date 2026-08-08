// Public API
$routes->group('api', function($routes){
    $routes->post('register', 'Auth::register');
    $routes->post('login', 'Auth::login');
});

// Anggota (dan semua user login)
$routes->group('api', ['filter' => 'auth'], function($routes){
    $routes->get('profile', 'Auth::profile');
    $routes->get('kategori', 'Kategori::index');
    $routes->get('buku', 'Buku::index');

    // Riwayat peminjaman
    $routes->get('peminjaman', 'Peminjaman::index');
});

// Admin + Petugas
$routes->group('api', ['filter' => 'staff'], function($routes){
    // Proses peminjaman
    $routes->post('peminjaman', 'Peminjaman::pinjam');

    // Proses pengembalian
    $routes->put('peminjaman/(:num)/kembalikan', 'Peminjaman::kembalikan/$1');
});

// Admin saja
$routes->group('api', ['filter' => 'admin'], function($routes){
    // CRUD Kategori
    $routes->post('kategori', 'Kategori::create');
    $routes->put('kategori/(:num)', 'Kategori::update/$1');
    $routes->delete('kategori/(:num)', 'Kategori::delete/$1');

    // CRUD Buku
    $routes->post('buku', 'Buku::create');
    $routes->put('buku/(:num)', 'Buku::update/$1');
    $routes->delete('buku/(:num)', 'Buku::delete/$1');

    // Nanti: CRUD Anggota
    // Nanti: Laporan Peminjaman
});