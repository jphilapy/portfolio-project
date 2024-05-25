<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

define('LAYOUTS', __DIR__ . '/src/Layouts/');
define('URL', 'http://localhost/mvc/');

require 'vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];

$router = require './src/routes.php';
$router->dispatch($uri);
