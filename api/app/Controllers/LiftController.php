<?php

namespace Carbon\Controllers;
use Carbon\Models\Lift;
use Carbon\Models\LiftType;

class LiftController extends Controller {
	public function postLift($request, $response) {

		if ($request->getParam('date') == "") {
			$date = strtotime('today midnight');
		} else {
			$date = strtotime($request->getParam('date'));
		}

		$date = date("Y-m-d H:i:s", $date);

		$lift = [
			'weight' => $request->getParam('weight'),
			'reps' => $request->getParam('reps'),
			'date' => $date,
			'user' => $this->auth->user()->id,
		];

		// If it is a new type, add the lift with that type and create a new one
		if ($request->getParam('newType') != "") {
			$lift['type'] = $request->getParam('newType');
			LiftType::create([
				'name' => $request->getParam('newType'),
				'user' => $this->auth->user()->id,
			]);
		} else {
			$lift['type'] = $request->getParam('liftType');
		}

		Lift::create($lift);

		return $response->withRedirect($this->router->pathFor('home'));
	}

	public function showLiftTable($request, $response, $args) {

		$lifts = Lift::where('user', $this->auth->user()->id)->orderBy('date', 'desc')->get();

		return $this->view->render($response, 'liftTable.twig', [
			'lifts' => $lifts
		]);
	}

	public function deleteLiftFromTable($request, $response, $args) {

		Lift::where('id', $args['id'])->delete();

		return $response->withRedirect($this->router->pathFor('lift.table'));
	}
}
