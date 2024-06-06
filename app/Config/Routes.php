<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->get('/login', 'Login::index');
$routes->post('/login', 'Login::index');
$routes->get('/info', 'Info::index');
$routes->get('/logout', 'Login::logout');
$routes->get('/profil', 'Profil::index');
$routes->get('/jadwal', 'Pbm::jadwal');
$routes->get('/agendaguru', 'AgendaGuru::index');
$routes->get('/agendaguru/baru', 'AgendaGuru::baru');
$routes->post('/agendaguru/baru', 'AgendaGuru::baru');
$routes->get('/agendaguru/absensi', 'AgendaGuru::absensi');



//test
$routes->get('/r', 'Pbm::rombel_jadwal');
$routes->get('/g', 'Login::getCookie');
$routes->get('/d', 'Login::delCookie');
$routes->get('/a', 'Login::addCookie');

service('auth')->routes($routes);
