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
// $routes->get('/profil', 'Profil::index');
$routes->get('/jadwal', 'Pbm::jadwal');
$routes->get('/agendaguru', 'AgendaGuru::index');
$routes->get('/agendaguru/edit/(.+)', 'AgendaGuru::edit/$1');
$routes->post('/agendaguru/edit/(.+)', 'AgendaGuru::edit/$1');
//$routes->get('/agendaguru/baru', 'AgendaGuru::baru');
$routes->get('/agendaguru/baru/(.+)', 'AgendaGuru::baru/$1');
$routes->get('/agendaguru/baru_telat', 'AgendaGuru::baru_telat');
$routes->post('/agendaguru/simpan', 'AgendaGuru::simpan');
$routes->get('/agendaguru/hapus/(.+)', 'AgendaGuru::hapus/$1');
$routes->post('/agendaguru/baru/(.+)', 'AgendaGuru::baru/$1');

$routes->get('/agendaguru/absensi', 'AgendaGuru::absensi');
$routes->get('/agendaguru/presensi/(.+)', 'AgendaGuru::presensi/$1/$2');
$routes->get('/agendaguru/tambahpresensi/(.+)', 'AgendaGuru::tambahpresensi/$1');
$routes->get('/agendaguru/hapuspresensi/(.+)', 'AgendaGuru::hapuspresensi/$1/$2/$3');
$routes->post('/agendaguru/simpanpresensi', 'AgendaGuru::simpanpresensi');
$routes->post('/agendaguru/hapus/(.+)', 'AgendaGuru::hapus/$1');

$routes->get('/agendaguru/tatapmuka', 'AgendaGuru::tatapmuka');
$routes->post('/agendaguru/tatapmuka', 'AgendaGuru::tatapmuka');

//lapor
$routes->get('/agendaguru/lapor', 'AgendaGuru::lapor');
$routes->post('/agendaguru/lapor', 'AgendaGuru::lapor');

//cetak
$routes->get('/cetakagenda', 'Cetak::agenda');
$routes->post('/cetakagenda', 'Cetak::agenda');
$routes->get('/cetakagendatuta', 'Cetak::agenda_tuta');
$routes->post('/cetakagendatuta', 'Cetak::agenda_tuta');
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

//tendik
$routes->get('/tendik', 'Tendik::index');
$routes->get('/tendikbaru', 'Tendik::baru');
$routes->post('/tendiksimpan', 'Tendik::baru');
$routes->get('/tendik/hapus/(.+)', 'Tendik::hapus/$1');
$routes->post('/tendik/hapus/(.+)', 'Tendik::hapus/$1');
$routes->get('/tendikedit/(.+)', 'Tendik::edit/$1');
//$routes->get('/tutaedit)', 'TugasTambahan::edit');
$routes->post('/tendikedit/(.+)', 'Tendik::edit/$1');


//cetak
// $routes->get('/cetakagenda', 'Cetak::agenda');
// $routes->post('/cetakagenda', 'Cetak::agenda');
$routes->get('/cetakagendatendik', 'Cetak::agenda_tendik');
$routes->post('/cetakagendatendik', 'Cetak::agenda_tendik');

$routes->get('/tuta/hapus/(.+)', 'TugasTambahan::hapus/$1');
$routes->post('/tuta/hapus/(.+)', 'TugasTambahan::hapus/$1');
$routes->get('/tutaedit/(.+)', 'TugasTambahan::edit/$1');
//$routes->get('/tutaedit)', 'TugasTambahan::edit');
$routes->post('/tutaedit/(.+)', 'TugasTambahan::edit/$1');

//admin
$routes->get('/admin', 'Login::index');
$routes->get('/admin/perbaiki_jam', 'Admin::perbaiki_jam');
$routes->get('/admin/reset/(.+)', 'Admin::reset/$1');
$routes->get('/admin/ambil_alih', 'Admin::ambil_alih');
$routes->get('/admin/ambil_alih/(.+)', 'Admin::ambil_alih/$1');

//Piket
$routes->get('/piket', 'Piket::index');
$routes->get('/piketbaru', 'Piket::lapor');
$routes->get('/home/get_items', 'Home::get_items');
$routes->get('/gi', 'Home::get_items');
$routes->get('/terlambat', 'Piket::terlambat');
$routes->get('/tampil_siswa/(.+)', 'Piket::tampil_siswa/$1');
//$routes->post('/tampil_siswa', 'Piket::tampil_siswa');
$routes->post('/tampil_siswa/(.+)', 'Piket::tampil_siswa/$1');
$routes->post('/simpan_tl/(.+)', 'Piket::simpan_tl/$1');

//Profil
$routes->get('/profil', 'Info::profil');

//FP
$routes->get('/fp_upacara', 'Fp::upacara');
$routes->get('/rekap_upacara', 'Info::rekap_upacara');
$routes->get('/fp_harian', 'Fp::harian');
$routes->get('/olah_harian', 'Fp::olah_harian');
$routes->get('/rekap_harian', 'Info::rekap_harian');


//presensi siswa
$routes->get('/rekap_absensi', 'AgendaGuru::rekap_absensi');

//push
$routes->get('/push', 'Push::pesan');

//chat
//$routes->get('chat', 'Chat::index',['filter' => 'auth']);
$routes->get('/chat', 'Chat::index');
//Polling
$routes->get('/polling', 'Polling::index');

service('auth')->routes($routes);
