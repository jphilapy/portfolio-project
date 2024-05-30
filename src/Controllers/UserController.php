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

	public function index($page = '')
	{
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// Pagination parameters
		$currentPage = isset($page) && $page != '' ? intval($page) : 1;
		$perPage = 10; // Number of records per page

		// Calculate offset
		$offset = ($currentPage - 1) * $perPage;

		// Query to fetch users with pagination
		$stmt = $this->pdo->prepare("SELECT * FROM users LIMIT :limit OFFSET :offset");
		$stmt->bindParam(':limit', $perPage, PDO::PARAM_INT);
		$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
		$stmt->execute();
		$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

		// Query to count total number of users
		$stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM users");
		$stmt->execute();
		$totalRecords = $stmt->fetchColumn();
		$totalPages = ceil($totalRecords / $perPage);

		// Pass data to the view
		$this->render('user/index', [
			'users' => $users,
			'currentPage' => $currentPage,
			'totalPages' => $totalPages,
			'totalRecords' => $totalRecords
		]);
	}

	public function login()
	{
		$this->render('user/login');
	}

	public function logout()
	{
		unset($_SESSION['loggedin_user']);

		$this->render('user/login');
	}

	public function add_user()
	{
		// Pass user data to the view
		$this->render('user/add_user');
	}

	public function edit_user($id)
	{
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// Query to fetch user by ID
		$stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		// Pass user data to the view
		$this->render('user/edit_user', ['user' => $user]);
	}

	public function update_user()
	{
		// Create PDO instance
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// Get form data
		$id = (int)$_POST['id']; // Assuming you have an input field with name 'id' in your form
		$username = trim($_POST['username']);
		$email = trim($_POST['email']);
		$password = $_POST['password'];
		$passwordConfirmation = $_POST['password_confirmation'];
		$is_active = isset($_POST['is_active']) ? 1 : 0; // Assuming is_active is a checkbox

		// Validate user input
		$errors = [];
		if (empty($username)) {
			$errors[] = 'Username is required.';
		}
		if (empty($email)) {
			$errors[] = 'Email is required.';
		} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors[] = 'Invalid email format.';
		}

		if (!empty($password) && ($password !== $passwordConfirmation)) {
			$errors[] = 'Passwords do not match.';
		}

		if (!empty($errors)) {
			// Query to fetch user by ID
			$stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			$user = $stmt->fetch(PDO::FETCH_ASSOC);

			$this->render('user/edit_user', ['errors' => $errors, 'user' => $user]);
			return;
		}

		// Update user record in the database
		$stmt = $this->pdo->prepare("UPDATE users SET username = :username, email = :email WHERE id = :id");
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();

		// Redirect or output success message
		header('Location: /users');
	}

	public function save_user()
	{
		// Check if the form was submitted
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$username = trim($_POST['username']);
			$email = trim($_POST['email']);
			$password = $_POST['password'];
			$passwordConfirmation = $_POST['password_confirmation'];
			$is_active = isset($_POST['is_active']) ? 1 : 0; // Assuming is_active is a checkbox

			// Validate user input
			$errors = [];
			if (empty($username)) {
				$errors[] = 'Username is required.';
			}
			if (empty($email)) {
				$errors[] = 'Email is required.';
			} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors[] = 'Invalid email format.';
			}
			if (empty($password)) {
				$errors[] = 'Password is required.';
			} elseif ($password !== $passwordConfirmation) {
				$errors[] = 'Passwords do not match.';
			}

			if (!empty($errors)) {
				$this->render('user/add_user', ['errors' => $errors]);
				return;
			}

			// Connect to the database using PDO
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// Prepare the SQL statement
			$stmt = $this->pdo->prepare("INSERT INTO users (username, email, password, is_active) VALUES (:username, :email, :password, :is_active)");
			// Add more fields as needed

			// Bind parameters
			$stmt->bindParam(':username', $username);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':password', $password);
			$stmt->bindParam(':is_active', $is_active);
			// Bind more parameters as needed

			// Execute the SQL statement
			$stmt->execute();

			// Redirect or display a success message
			// Example redirect:
			header('Location: /users');
			exit();
		}

		// If the form was not submitted, render the form view
		$this->render('user/add_user');
	}

	public function delete_user($id)
	{
		// Check if the user ID is provided (you may need to adjust this logic based on your application)
		if (isset($id)) {
			$userId = $id;

			// Connect to the database using PDO
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// Prepare the SQL statement
			$stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");

			// Bind the user ID parameter
			$stmt->bindParam(':id', $userId);

			// Execute the SQL statement
			$stmt->execute();

			// Redirect or display a success message
			// Example redirect:
			header('Location: /users');
			exit();
		} else {
			// Handle the case where the user ID is not provided
			// You may display an error message or redirect to another page
		}
	}

}

