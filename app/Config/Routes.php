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
//walas
$routes->get('/siswa', 'Walas::index');

$routes->get('/admin/isitgldibuat', 'Admin::Isitgldibuat');

//test
$routes->get('/r', 'Pbm::rombel_jadwal');
$routes->get('/g', 'Login::getCookie');
$routes->get('/d', 'Login::delCookie');
$routes->get('/a/(.+)', 'Login::addCookie/$1');

service('auth')->routes($routes);
