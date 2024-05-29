<?php

use PortfolioApp\Controllers\GoogleLoginController;
use PortfolioApp\Router;
use PortfolioApp\Controllers\UserController;
use PortfolioApp\Controllers\GeneralController;
use PortfolioApp\Controllers\CourseController;

$router = new Router();

$router->addRoute('GET','/', GeneralController::class, 'index');
$router->addRoute('GET','/users/', UserController::class, 'index');
$router->addRoute('GET','/users', UserController::class, 'index');
$router->addRoute('GET','/users/page/{page}', UserController::class, 'index', ['page']);

$router->addRoute('GET','/login', UserController::class, 'login');

/* USERS */
// edit user
$router->addRoute('GET','/edit_user/{id}', UserController::class, 'edit_user', ['id']);
$router->addRoute('POST','/update_user', UserController::class, 'update_user');
$router->addRoute('GET','/delete_user/{id}', UserController::class, 'delete_user', ['id']);

// add user
$router->addRoute('GET','/add_user', UserController::class, 'add_user', ['id']);
$router->addRoute('POST','/save_user', UserController::class, 'save_user');

/* COURSE */
// edit course
$router->addRoute('GET','/edit_course/{id}', CourseController::class, 'edit_course', ['id']);
$router->addRoute('POST','/update_course', CourseController::class, 'update_course');
$router->addRoute('GET','/delete_course/{id}', CourseController::class, 'delete_course', ['id']);

// add course
//$router->addRoute('GET','/add_user', CourseController::class, 'add_user', ['id']);
//$router->addRoute('POST','/save_user', CourseController::class, 'save_user');


$router->addRoute('GET','/login_google', GoogleLoginController::class, 'login');

return $router;
