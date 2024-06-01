<?php

namespace PortfolioApp\Controllers;

use PortfolioApp\Controller;

class AdminController extends Controller {

	public function __construct()
	{
		if (!isset($_SESSION['loggedin_user'])) {
			header('Location: /login');
			exit;
		}
	}
	public function dashboard() {
		// Pass data to the view
		$this->render('admin/dashboard');
	}
}

