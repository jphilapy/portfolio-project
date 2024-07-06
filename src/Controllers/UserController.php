<?php

namespace PortfolioApp\Controllers;

use PortfolioApp\Controller;
use PDO;

class UserController extends Controller
{

	private $pdo;

	public function __construct(PDO $pdo)
	{
		$this->pdo = $pdo;
	}

	public function login(): void
	{
		$this->render('user/login');
	}

	public function login_db(): void
	{
		// Validate user input
		$errors = [];
		$email = trim($_POST['username']);
		$password = $_POST['password'];

		if (empty($email)) {
			$errors[] = 'Username is required.';
		} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors[] = 'Invalid email format.';
		}

		if (empty($password)) {
			$errors[] = 'Password is required.';
		}

		if (!empty($errors)) {
			$this->render('user/login', ['errors' => $errors]);
			return;
		}

		// TASK: match encrypted password to database
		$sql = "SELECT password FROM users WHERE email = :email";

		$email = $_POST['username'];
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(':email', $email);
		$stmt->execute();

		$storedHash = $stmt->fetchColumn();

		if ($storedHash && password_verify($_POST['password'], $storedHash)) {
			$_SESSION['loggedin_user'] = $email;
			header('location: /dashboard');
			return;
		}

		$this->render('user/login', ['errors' => ['Either username or password is incorrect.']]);
	}

	public function register(): void
	{
		$this->render('user/register');
	}

	public function register_db(): void
	{
		// Validate user input
		$errors = [];
		$email = trim($_POST['username']);
		$password = $_POST['password'];
		$confirm_password = $_POST['confirm_password'];

		if (empty($email)) {
			$errors[] = 'Username is required.';
		} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors[] = 'Invalid email format.';
		}

		if (empty($password)) {
			$errors[] = 'Password is required.';
		}

		if (empty($confirm_password)) {
			$errors[] = 'Confirmation password is required.';
		}

		if (!empty($errors)) {
			$this->render('user/register', ['errors' => $errors]);
			return;
		}

		// TASK: encrypt password
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $this->pdo->prepare("INSERT INTO users (email, password, is_active) VALUES (:email, :password, :is_active)");

		$is_active = 1; //TASK: set to active for now. Later send email verification to activate

		$hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

		$stmt->bindParam(':email', $_POST['username']);
		$stmt->bindParam(':password', $hashedPassword);
		$stmt->bindParam(':is_active', $is_active);

		$success = $stmt->execute();

		if ($success) {
			header('location: /register-confirm');
			exit;
		}
	}

	public function logout(): void
	{
		unset($_SESSION['loggedin_user']);

		header('location: /login');
	}

	public function register_confirm()
	{
		$this->render('user/register-confirm');
	}
}

