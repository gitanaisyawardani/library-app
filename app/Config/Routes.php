<?php

namespace Config;

use CodeIgniter\Config\Services;

$routes = Services::routes();

// Default route (biar / langsung ke books)
$routes->get('/', 'BookController::index');

// Books
$routes->get('books', 'BookController::index');
$routes->get('books/(:num)', 'BookController::detail/$1');

// Members
$routes->get('members', 'MemberController::index');
$routes->get('members/(:num)', 'MemberController::detail/$1');