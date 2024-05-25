<?php

namespace MVC\Controllers;

use MVC\Controller;
use MVC\Models\User;
use PDO;

class GeneralController extends Controller {

	public function index() {


		// Pass data to the view
		$this->render('site/index');
	}
}

