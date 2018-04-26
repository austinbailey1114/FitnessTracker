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
		$name = $this->auth->user()->name;

		return $this->view->render($response, 'index.twig', [
			'bodyweights' => $bodyweights,
			'lifts' => $lifts,
			'foods' => $foods,
			'lifttypes' => $lifttypes,
			'name' => $name,
		]);
	}

	public function login($request, $response) {
		return $this->view->render($response, 'login.twig');
	}

}
