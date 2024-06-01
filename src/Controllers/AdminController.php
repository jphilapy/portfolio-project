<?php

namespace PortfolioApp\Controllers;

use PDO;
use PortfolioApp\Controller;

class AdminController extends Controller {

	private $pdo;

	public function __construct(PDO $pdo)
	{
		if (!isset($_SESSION['loggedin_user'])) {
			header('Location: /login');
			exit;
		}

		$this->pdo = $pdo;
	}

	public function dashboard() {
		// Pass data to the view
		$this->render('admin/dashboard');
	}

	public function users($page = ''): void
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
}

