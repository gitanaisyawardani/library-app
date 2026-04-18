<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'BookController::index');

// Books
$routes->get('books', 'BookController::index');
$routes->get('books/(:num)', 'BookController::detail/$1');

// Search Books Online
$routes->get('search-books', 'BookController::searchOnline');

// Members
$routes->get('members', 'MemberController::index');
$routes->get('members/(:num)', 'MemberController::detail/$1');