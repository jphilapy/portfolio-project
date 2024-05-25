<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

require __DIR__ . '/vendor/autoload.php';

// Load environment variables
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Setup layouts and app URL
define('LAYOUTS', __DIR__ . '/src/Layouts/');
define('APP_URL', $_ENV['APP_URL']);

// Initialize PHP-DI container
use DI\ContainerBuilder;

$containerBuilder = new ContainerBuilder();
$container = $containerBuilder->build();

// Register dependencies in the container
$container->set('PDO', function () {
	// Set up PDO connection to your database
	$dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'];
	$username = $_ENV['DB_USER'];
	$password = $_ENV['DB_PASSWORD'];
	return new PDO($dsn, $username, $password);
});

$container->set('PortfolioApp\Models\User', function ($container) {
	// Inject PDO dependency into User model constructor
	return new PortfolioApp\Models\User($container->get('PDO'));
});

$container->set('Google\Client', function () {
	// Instantiate Google Client with necessary configurations
	$client = new Google\Client();
	$client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
	$client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
	$client->setRedirectUri($_ENV['LOGIN_REDIRECT_URL']);
	$client->addScope('email');
	return $client;
});

// Retrieve router and dispatch request
$router = require './src/routes.php';
$router->dispatch($_SERVER['REQUEST_URI']);
