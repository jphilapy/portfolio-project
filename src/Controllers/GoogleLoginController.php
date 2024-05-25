<?php

namespace PortfolioApp\Controllers;

use PortfolioApp\Controller;
use Google\Client;
use PortfolioApp\Models\User;
use PDO;

class GoogleLoginController extends Controller {

	private $userModel;
	private $googleClient;

//	public function __construct(User $userModel, Client $googleClient) {
	public function __construct(User $userModel) {
//		$this->userModel = $userModel;
//		$this->googleClient = $googleClient;
	}

	public function login() {
		$this->googleClient->setClientId($_ENV['GOOGLE_CLIENT_ID']);
		$this->googleClient->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
		$this->googleClient->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);
		$this->googleClient->addScope('email');

		if(isset($_GET['code'])) {
			$this->googleClient->fetchAccessTokenWithAuthCode($_GET['code']);
			$userInfo = $this->googleClient->verifyIdToken();
			$userEmail = $userInfo['email'];

			$user = $this->userModel->getUserByEmail($userEmail);

			if($user) {
				$this->googleClient->setAccessToken($user['access_token']);

				if ($this->googleClient->isAccessTokenExpired()) {
					$this->googleClient->fetchAccessTokenWithRefreshToken($user['refresh_token']);
					$accessToken = $this->googleClient->getAccessToken();
					$this->userModel->updateUserAccessToken($userEmail, json_encode($accessToken));
				}

				$_SESSION['access_token'] = $this->googleClient->getAccessToken();
				header('Location: ' . $_ENV['APP_URL']);
				exit;
			} else {
				$accessToken = $this->googleClient->getAccessToken();
				$refreshToken = $this->googleClient->getRefreshToken();
				$this->userModel->createUser($userEmail, json_encode($accessToken), $refreshToken);
				$_SESSION['access_token'] = $accessToken;
				header('Location: ' . $_ENV['APP_URL']);
				exit;
			}
		} else {
			$authUrl = $this->googleClient->createAuthUrl();
			header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
			exit;
		}
	}
}

