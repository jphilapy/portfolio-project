<?php

namespace PortfolioApp\Controllers;

use PortfolioApp\Controller;
use PortfolioApp\Models\User;
use PDO;

class GeneralController extends Controller {

	public function index() {


		// Pass data to the view
		$this->render('site/index');
	}
}

