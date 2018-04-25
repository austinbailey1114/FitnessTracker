<?php

namespace Carbon\Controllers;

class LiftController extends Controller {
	//api functions
	public function getLifts($request, $response, $args) {
		$query = new Query();
		$mydata = $query->table('lifts')->where('user', '=', $args['id'])->execute();

		return $response->withJson($mydata, 200, JSON_PRETTY_PRINT);
	}

	public function postLift($request, $response) {
		$data = $request->getParsedBody();

		$query = new Query();

		//insert type into lift types if it does not exist
		//NOTE: need to specify that it is a new type to work
		if ($_POST['isNewType']) {
			$inserted = $query->table('lifttypes')->insert(array('name', 'user'), array($data['type'], $data['id']))->execute();
		} else {
			$inserted = true;
		}

		//insert lift
		$result = $query->table('lifts')->insert(array('weight', 'reps', 'type', 'user'), array($data['weight'], $data['reps'], $data['type'], $data['id']))->execute();

		if ($result && $inserted) {
			echo "New lift added successfully";
			return $response->withStatus(200);
		} else {
			echo "Failed to add lift. Please ensure all variables are properly defined";
			return $response->withStatus(400);
		}
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

	public function addLift($request, $response) {
		$data = $request->getParsedBody();

		if (isset($_POST['type'])) {
		    $data['type'] = $_POST['type'];
		    $data['isNewType'] = true;
		} else {
		    $data['type'] = $_POST['lifttypes'];
		    $data['isNewType'] = false;
		}

		$data['id'] = $_SESSION['id'];

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, getenv('URL') . 'api/lifts/');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$result = curl_exec($ch);

		if ($result) {
			$_SESSION['message'] = 'success';
			$_SESSION['lift'] = $data['type'];
		} else {
			$_SESSION['message'] = 'failed';
		}
		return $response->withStatus(200)->withHeader('Location', '../');
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