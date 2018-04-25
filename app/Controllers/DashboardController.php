<?php

namespace Carbon\Controllers;
use Carbon\Models\Lift;
use Carbon\Models\LiftType;
use Carbon\Models\Food;
use Carbon\Models\Bodyweight;

class DashboardController extends Controller {
	public function index($request, $response) {
		$id = $this->auth->user()->id;

		$bodyweights = Bodyweight::where('user', $id)->get();
		$lifts = Lift::where('user', $id)->get();
		$foods = Food::where('user', $id)->get();
		$lifttypes = LiftType::where('user', $id)->get();

		return $this->view->render($response, 'index.twig', [
			'bodyweights' => $bodyweights,
			'lifts' => $lifts,
			'foods' => $foods,
			'lifttypes' => $lifttypes,
		]);
	}
	public function login($request, $response) {
		return $this->view->render($response, 'login.twig');
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
