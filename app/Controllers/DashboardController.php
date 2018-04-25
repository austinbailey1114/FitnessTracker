<?php

namespace Carbon\Controllers;

class DashboardController extends Controller {
	public function index($request, $response) {
		if (!isset($_SESSION['id'])) {
			return $this->view->render($response, 'login.php');
		} else if (time() - $_SESSION['created'] > 3600) {
			session_unset();
			session_destroy();
			return $this->view->render($response, 'login.php');
		}
		return $this->view->render($response, 'index.php');
	}
	public function login($request, $response) {
		return $this->view->render($response, 'login.php');
	}
	public function verify($request, $response) {
		$data = $request->getParsedBody();

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, getenv('URL') . 'users/checkLogin');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$result = curl_exec($ch);
		$result = json_decode(trim($result), true);
		$result = $result[0];

		if ($result['id'] != null) {
			$_SESSION['id'] = $result['id'];
			$_SESSION['name'] = $result['name'];
			$_SESSION['created'] = time();
			//$_SESSION['email'] = $result['email'];
			return $response->withHeader('Location', './');
		} else {
			return $response->withHeader('Location', './login');
		}
	}

	public function logout($request, $response) {
		session_unset();
		session_destroy();
		return $this->view->render($response, 'login.php');
	}

	public function newUser($request, $response) {
		return $this->view->render($response, 'accountCreate.php');
	}

	public function reset($request, $response) {
		return $this->view->render($response, 'reset.php');
	}

}