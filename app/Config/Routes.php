<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/register', 'Register::index');
$routes->post('/register-users', 'Register::save');

$routes->get('/check-db', 'Base::index');

$routes->get('/login', 'Login::index');
$routes->post('/login-users', 'Login::process');

$routes->get('/edit', 'Edit::index');
$routes->post('/edit/save', 'Edit::save');
$routes->post('edit/delete', 'Edit::delete');


$routes->get('/landing', 'Landing::index');
$routes->post('/logout', 'Landing::logout');
