<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->get('/login', 'Login::index');

$routes->get('/login/gantipassword/(.+)', 'Login::gantipassword/$1');
$routes->post('/login/gantipassword/(.+)', 'Login::gantipassword/$1');
$routes->post('/login', 'Login::index');
$routes->get('/info', 'Info::index');
$routes->get('/logout', 'Login::logout');
$routes->get('/profil', 'Profil::index');
$routes->get('/jadwal', 'Pbm::jadwal');
$routes->get('/agendaguru', 'AgendaGuru::index');
$routes->get('/agendaguru/baru', 'AgendaGuru::baru');
$routes->get('/agendaguru/baru_telat', 'AgendaGuru::baru_telat');
$routes->post('/agendaguru/simpan', 'AgendaGuru::simpan');
$routes->get('/agendaguru/hapus/(.+)', 'AgendaGuru::hapus/$1');
$routes->post('/agendaguru/baru', 'AgendaGuru::baru');

$routes->get('/agendaguru/absensi', 'AgendaGuru::absensi');
$routes->get('/agendaguru/presensi/(.+)', 'AgendaGuru::presensi/$1/$2');
$routes->get('/agendaguru/tambahpresensi/(.+)', 'AgendaGuru::tambahpresensi/$1');
$routes->get('/agendaguru/hapuspresensi/(.+)', 'AgendaGuru::hapuspresensi/$1/$2/$3');
$routes->post('/agendaguru/simpanpresensi', 'AgendaGuru::simpanpresensi');
$routes->post('/agendaguru/hapus/(.+)', 'AgendaGuru::hapus/$1');

//cetak
$routes->get('/cetakagenda', 'Cetak::agenda');
$routes->post('/cetakagenda', 'Cetak::agenda');
//walas
$routes->get('/siswa', 'Walas::index');
$routes->get('/jam', 'Pbm::jadwal_kelas');

$routes->get('/admin/isitgldibuat', 'Admin::Isitgldibuat');

//test
$routes->get('/r', 'Pbm::rombel_jadwal');
$routes->get('/g', 'Login::getCookie');
$routes->get('/d', 'Login::delCookie');
$routes->get('/a/(.+)', 'Login::addCookie/$1');

//tuta
$routes->get('/tuta', 'TugasTambahan::index');
$routes->get('/tutabaru', 'TugasTambahan::baru');
$routes->post('/tutasimpan', 'TugasTambahan::baru');

$routes->get('/tuta/hapus/(.+)', 'TugasTambahan::hapus/$1');
$routes->post('/tuta/hapus/(.+)', 'TugasTambahan::hapus/$1');
$routes->get('/tutaedit/(.+)', 'TugasTambahan::edit/$1');
//$routes->get('/tutaedit)', 'TugasTambahan::edit');
$routes->post('/tutaedit/(.+)', 'TugasTambahan::edit/$1');

//admin
$routes->get('/admin', 'Admin::index');
$routes->get('/admin/ambilalih', 'Admin::ambil_alih');
$routes->get('/admin/ambilalih/(.+)', 'Admin::ambil_alih/$1');

//Piket
$routes->get('/home', 'Home::index');
$routes->get('/gi', 'Home::get_items');
$routes->get('/form_terlambat', 'Siswa::form_terlambat');
service('auth')->routes($routes);
