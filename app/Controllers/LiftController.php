<?php

namespace Carbon\Controllers;
use Carbon\Models\Lift;
use Carbon\Models\LiftType;

class LiftController extends Controller {
	//api functions
	public function getLifts($request, $response, $args) {
		$query = new Query();
		$mydata = $query->table('lifts')->where('user', '=', $args['id'])->execute();

		return $response->withJson($mydata, 200, JSON_PRETTY_PRINT);
	}

	public function postLift($request, $response) {

		if ($request->getParam('date') == "") {
			$date = strtotime('today midnight');
		} else {
			$date = "asdf";
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

	public function deleteLift($request, $response) {
		$data = $request->getParsedBody();

		$query = new Query();
		$result = $query->table('lifts')->delete('id', '=', $data['id'])->execute();

		if ($result) {
			echo "Item deleted successfully";
			return $response->withStatus(200);
		} else {
			echo "Unable to delete item. Please ensure all variables are properly defined";
			return $response->withStatus(400);
		}

	}

	//app functions
	public function showLiftTable($request, $response, $args) {
		return $this->view->render($response, 'liftTable.php');
	}

	public function deleteLiftFromTable($request, $response, $args) {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, getenv('URL') . 'api/lifts/');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($args));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$result = curl_exec($ch);

		if ($result) {
			$_SESSION['message'] = 'deleteSuccess';
		} else {
			$_SESSION['message'] = 'deleteFailed';
		}

		return $response->withStatus(200)->withHeader('Location', '../../');
	}
}
