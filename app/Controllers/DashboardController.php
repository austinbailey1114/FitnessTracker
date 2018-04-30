<?php

namespace Carbon\Controllers;
use Carbon\Models\Lift;
use Carbon\Models\LiftType;
use Carbon\Models\Food;
use Carbon\Models\Bodyweight;

class DashboardController extends Controller {
	public function index($request, $response) {
		$id = $this->auth->user()->id;


		$cals = $protein = $fat = $carbs = 0;
		$foods = Food::where('user', $id)->get();

		if (count($foods) > 0) {
			foreach ($foods as $food) {
				$cals += $food->calories;
				$protein += $food->protein;
				$fat += $food->fat;
				$carbs += $food->carbs;
			}
		}

		$nutrientCounts = [
			'cals' => $cals,
			'protein' => $protein,
			'fat' => $fat,
			'carbs' => $carbs
		];

		$name = $this->auth->user()->name;

		return $this->view->render($response, 'index.twig', [
			'bodyweights' => Bodyweight::where('user', $id)->get(),
			'lifts' => Lift::where('user', $id)->get(),
			'foods' => $foods,
			'lifttypes' => LiftType::where('user', $id)->get(),
			'name' => $name,
			'nutrientCounts' => $nutrientCounts
		]);
	}

	public function login($request, $response) {
		return $this->view->render($response, 'login.twig');
	}

	public function logout($request, $response) {
		$this->auth->logout();

		return $response->withRedirect($this->router->pathFor('auth.signin'));
	}

}
