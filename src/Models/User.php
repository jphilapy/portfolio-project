<?php

namespace PortfolioApp\Models;

class User {
	public $name;
	public $email;
	public $username;

	public function __construct($name, $email, $jd) {
		$this->name = $name;
		$this->email = $email;
		$this->username = $jd;
	}
}

