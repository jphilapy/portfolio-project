<?php

namespace PortfolioApp\Models;

use PDO;

class User {
	public $name;
	public $email;
	public $username;
	private $connection;


	public function __construct(PDO $connection, $name, $email, $jd) {

		$this->name = $name;
		$this->email = $email;
		$this->username = $jd;

		$this->connection = $connection;
	}

	public function getUserByEmail($email) {
		$sql = "SELECT * FROM users WHERE email = ?";
		$stmt = $this->connection->prepare($sql);
		$stmt->execute([$email]);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function createUser($email, $accessToken, $refreshToken): bool|string
	{
		$sql = "INSERT INTO users (email, access_token, refresh_token) VALUES (?, ?, ?)";
		$stmt = $this->connection->prepare($sql);
		$stmt->execute([$email, $accessToken, $refreshToken]);
		return $this->connection->lastInsertId();
	}

	public function updateUserAccessToken($email, $accessToken): bool
	{
		$sql = "UPDATE users SET access_token = ? WHERE email = ?";
		$stmt = $this->connection->prepare($sql);
		return $stmt->execute([$accessToken, $email]);
	}
}

