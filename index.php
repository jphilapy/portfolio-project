<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

require __DIR__ . '/vendor/autoload.php';

// get dot env
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// setup layouts and app url
define('LAYOUTS', __DIR__ . '/src/Layouts/');
define('APP_URL', $_ENV['APP_URL']);

// do some mvc stuff
$uri = $_SERVER['REQUEST_URI'];

$router = require './src/routes.php';
$router->dispatch($uri);
