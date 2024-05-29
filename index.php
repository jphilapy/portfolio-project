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
use PortfolioApp\Controllers\UserController;
use PortfolioApp\Models\User;
use PortfolioApp\Test;

$container = new DI\Container();
$container->set(PDO::class, function () {
	// Set up PDO connection to your database
	$dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'];
	$username = $_ENV['DB_USER'];
	$password = $_ENV['DB_PASSWORD'];

	return new PDO($dsn, $username, $password);
});

$container->get(UserController::class);

// Retrieve router and dispatch request
$router = require './src/routes.php';
$router->dispatch($_SERVER['REQUEST_URI'], $container);


function logToFile($value)
{
	// Specify the path to the log file
	$logFile = __DIR__ . '/error_log.txt';

	// Get the type of the variable
	$type = gettype($value);

	// Prepare the log message
	$message = date('Y-m-d H:i:s') . ' - Type: ' . $type . ', Value: ' . print_r($value, true) . PHP_EOL;

	// Append the message to the log file
	file_put_contents($logFile, $message, FILE_APPEND);
}
