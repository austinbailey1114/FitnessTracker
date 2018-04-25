<?php

namespace Carbon\Controllers;

class BodyweightController extends Controller {

	//api
	public function getBodyweights($request, $response, $args) {
		$query = new Query();

		$mydata = $query->table('bodyweights')->where('user', '=', $args['id'])->execute();

		return $response->withJson($mydata, 200, JSON_PRETTY_PRINT);
	}

	public function postBodyweight($request, $response) {
		$data = $request->getParsedBody();

		$query = new Query();

		if (isset($_SESSION['id'])) {
			$id = $_SESSION['id'];
		} else {
			$id = $data['id'];
		}

		$result = $query->table('bodyweights')->insert(array('weight', 'user'), array($data['updateWeight'], $id))->execute();

		if ($result) {
			echo "New bodyweight added successfully";
			return $response->withStatus(200);
		} else {
			echo "Unable to add bodyweight. Please ensure all variables are added correctly";
			return $response->withStatus(400);
		}
	}

	public function deleteBodyweight($request, $response) {
		$data = $request->getParsedBody();

		$query = new Query();
		$result = $query->table('bodyweights')->delete('id', '=', $data['id'])->execute();

		if ($result) {
			echo "Item deleted successfully";
			return $response->withStatus(200);
		} else {
			echo "Unable to delete item. Please ensure all variables are properly defined";
			return $response->withStatus(400);
		}

	}

	//app pages
	public function showBodyweightTable($request, $response) {
		return $this->view->render($response, 'bodyweightTable.php');
	}

	public function addBodyweight($request, $response) {
		$data = $request->getParsedBody();

		$data['id'] = $_SESSION['id'];

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, getenv('URL') . 'api/bodyweights/');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$result = curl_exec($ch);

		var_dump($result);


		if ($result) {
			$_SESSION['message'] = 'success';
		} else {
			$_SESSION['message'] = 'failed';
		}
		
		return $response->withHeader('Location', '../');
		
	}

	public function deleteBodyweightFromTable($request, $response, $args) {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, getenv('URL') . 'api/bodyweights/');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($args));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$result = curl_exec($ch);

		if ($result) {
			$_SESSION['message'] = 'deleteSuccess';
		} else {
			$_SESSION['message'] = 'deleteFailed';
		}


		return $response->withHeader('Location', '../../');
		
	}
}