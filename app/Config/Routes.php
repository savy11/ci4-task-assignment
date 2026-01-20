<?php
namespace Config;

use App\Controllers\AuthController;
use App\Controllers\TaskController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes = Services::routes();

// $routes->get('/', 'Home::index');

// Auth routes
$routes->get('register', [AuthController::class, 'showRegisterForm']);
$routes->post('auth/register', [AuthController::class, 'register']);
$routes->get('login', [AuthController::class, 'showLoginForm']);
$routes->post('auth/login', [AuthController::class, 'login']);
$routes->get('logout', [AuthController::class, 'logout']);

// Task routes (protected)
$routes->get('tasks', [TaskController::class, 'index']);  // List
$routes->post('tasks', [TaskController::class, 'create']);
$routes->get('tasks/create', [TaskController::class, 'showCreateForm']);
$routes->get('tasks/edit/(:num)', [TaskController::class, 'showEditForm']);  // Edit form
$routes->put('tasks/(:num)', [TaskController::class, 'update']);
$routes->get('tasks/view/(:num)', [TaskController::class, 'show']);  // Single view
$routes->delete('tasks/(:num)', [TaskController::class, 'delete']);