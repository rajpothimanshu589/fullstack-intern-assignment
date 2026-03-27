<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->options('(:any)', function () {
    return response()->setStatusCode(200);
});

$routes->get('/', 'Home::index');
$routes->post('/register', 'Auth::register');
$routes->post('/login', 'Auth::login');

$routes->post('/teacher', 'Teacher::create');
$routes->post('teacher/createWithUser', 'Teacher::createWithUser');
$routes->get('teachers', 'Teacher::getTeachersWithUsers');
// $routes->get('/teachers', 'Teacher::list');
// $routes->get('/teachers', 'Teacher::getAll');
$routes->get('/teachers', 'Teacher::getTeachersWithUsers');
$routes->get('/teacher/(:num)', 'Teacher::show/$1');
$routes->put('/teacher/(:num)', 'Teacher::update/$1');
$routes->delete('/teacher/(:num)', 'Teacher::delete/$1');



$routes->post('/add-teacher', 'Teacher::createWithUser', ['filter' => 'auth']);


$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('teachers', 'Teacher::getTeachersWithUsers');
});