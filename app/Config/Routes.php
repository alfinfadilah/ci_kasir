<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//product
$routes->get('/', 'Home::index');
$routes->get('/product','product::index');
$routes->post('/product/simpan','product::simpan_product');
$routes->get('/product/tampil','product::tampil_product');
$routes->post('/product/hapus', 'product::hapus_product');
$routes->post('/product/update', 'product::update');

//pelanggan
$routes->get('/pelanggan','pelanggan::index');
$routes->post('/pelanggan/simpan','pelanggan::simpan_pelanggan');
$routes->get('/pelanggan/tampil','pelanggan::tampil_pelanggan');
$routes->post('/pelanggan/hapus', 'pelanggan::hapus_pelanggan');
$routes->post('/pelanggan/update', 'pelanggan::update');
