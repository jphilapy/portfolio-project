<?php

use PortfolioApp\Controllers\AdminController;
use PortfolioApp\Controllers\GoogleLoginController;
use PortfolioApp\Router;
use PortfolioApp\Controllers\UserController;
use PortfolioApp\Controllers\Admin\UserController as AdminUserController;
use PortfolioApp\Controllers\GeneralController;
use PortfolioApp\Controllers\CourseController;

$router = new Router();

$router->addRoute('GET','/', GeneralController::class, 'index');

// dashboard
$router->addRoute('GET','/dashboard', AdminController::class, 'dashboard');

// users
$router->addRoute('GET','/users', AdminUserController::class, 'index');
$router->addRoute('GET','/users/page/{page}', UserController::class, 'index');

// login
$router->addRoute('GET','/login', UserController::class, 'login');
$router->addRoute('POST','/login', UserController::class, 'login_db');
$router->addRoute('GET','/logout', UserController::class, 'logout');

$router->addRoute('GET','/register', UserController::class, 'register');
$router->addRoute('POST','/register', UserController::class, 'register_db');

/* USERS */
// edit user
$router->addRoute('GET','/edit_user/{id}', AdminUserController::class, 'edit_user');
$router->addRoute('POST','/update_user', AdminUserController::class, 'update_user');
$router->addRoute('GET','/delete_user/{id}', AdminUserController::class, 'delete_user');

// add user
$router->addRoute('GET','/add_user', AdminUserController::class, 'add_user');
$router->addRoute('POST','/save_user', AdminUserController::class, 'save_user');

/* COURSE */
// edit course
$router->addRoute('GET','/edit_course/{id}', CourseController::class, 'edit_course');
$router->addRoute('POST','/update_course', CourseController::class, 'update_course');
$router->addRoute('GET','/delete_course/{id}', CourseController::class, 'delete_course');

// add course
//$router->addRoute('GET','/add_user', CourseController::class, 'add_user', ['id']);
//$router->addRoute('POST','/save_user', CourseController::class, 'save_user');


$router->addRoute('GET','/login_google', GoogleLoginController::class, 'login');

return $router;
