<?php

namespace Carbon\Controllers;
use Carbon\Models\Bodyweight;

class BodyweightController extends Controller {
	public function getBodyweights($request, $response, $args) {
		$query = new Query();

		$mydata = $query->table('bodyweights')->where('user', '=', $args['id'])->execute();

		return $response->withJson($mydata, 200, JSON_PRETTY_PRINT);
	}

	public function postBodyweight($request, $response) {
		$date = strtotime('today midnight');
		$date = date("Y-m-d H:i:s", $date);

		Bodyweight::create([
			'user' => $this->auth->user()->id,
			'date' => $date,
			'weight' => $request->getParam('weight')
		]);

		return $response->withRedirect($this->router->pathFor('home'));
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
		return $this->view->render($response, 'bodyweightTable.twig', [
			'bodyweights' => Bodyweight::where('user', $this->auth->user()->id)->get()
		]);
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
		Bodyweight::where('id', $args['id'])->delete();
		return $response->withRedirect($this->router->pathFor('bodyweight.table'));
	}
}
