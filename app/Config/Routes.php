<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// $routes->get('/tabel', 'Tabel::index');

// Grup untuk Mahasiswa
$routes->group('mahasiswa', static function ($routes) {
    $routes->get('/', 'MahasiswaController::index');          // Menampilkan semua mahasiswa (view tabel Anda)
    $routes->get('create', 'MahasiswaController::create');    // Menampilkan form tambah mahasiswa
    $routes->post('store', 'MahasiswaController::store');     // Menyimpan data mahasiswa baru
    $routes->get('edit/(:num)', 'MahasiswaController::edit/$1'); // Menampilkan form edit mahasiswa ($1 adalah id)
    $routes->post('update/(:num)', 'MahasiswaController::update/$1'); // Memperbarui data mahasiswa ($1 adalah id)
    $routes->delete('delete/(:num)', 'MahasiswaController::delete/$1'); // Menghapus mahasiswa ($1 adalah id)
    // Jika Anda ingin menggunakan method POST untuk delete tanpa method spoofing
    // $routes->post('delete/(:num)', 'MahasiswaController::delete/$1');
});
