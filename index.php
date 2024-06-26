<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', true);

require __DIR__ . '/vendor/autoload.php';

// Load environment variables
use Dotenv\Dotenv;


$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Setup layouts and app URL
const LAYOUTS = __DIR__ . '/src/Layouts/';

use Google\Client;
use PortfolioApp\Controllers\AdminController;
use PortfolioApp\Controllers\GoogleLoginController;
use PortfolioApp\Controllers\UserController;
use PortfolioApp\Models\User;
use Psr\Container\ContainerInterface;

$container = new DI\Container();
$container->set(PDO::class, function () {
	// Set up PDO connection to your database
	if($_ENV['DATABASE'] === 'mysql') {
		$dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'];
		$username = $_ENV['DB_USER'];
		$password = $_ENV['DB_PASSWORD'];

		try {
			return new PDO($dsn, $username, $password);
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
		}
	} else if($_ENV['DATABASE'] === "sqlite") {
		$dsn = 'sqlite:database/'.$_ENV['DB_NAME'];

		try {
			return new PDO($dsn);
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
		}
	}
});

$container->set(User::class, function (ContainerInterface $c) {
	return new User($c->get(PDO::class), '','','');
});

$container->set(Client::class, function () {
	return new Client();
});

$container->set(GoogleLoginController::class, function (ContainerInterface $c) {
	return new GoogleLoginController(
		$c->get(User::class),
		$c->get(Client::class)
	);
});

$container->get(UserController::class);
$container->get(GoogleLoginController::class);
//$container->get(AdminController::class);



// Retrieve router and dispatch request
$router = require './src/routes.php';
$router->dispatch($_SERVER['REQUEST_URI'], $container);


function logToFile($value): void
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
