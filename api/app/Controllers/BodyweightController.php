<?php

namespace Carbon\Controllers;
use Carbon\Models\Bodyweight;

class BodyweightController extends Controller {
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

	//app pages
	public function showBodyweightTable($request, $response) {
		return $this->view->render($response, 'bodyweightTable.twig', [
			'bodyweights' => Bodyweight::where('user', $this->auth->user()->id)->get()
		]);
	}

	public function deleteBodyweightFromTable($request, $response, $args) {
		Bodyweight::where('id', $args['id'])->delete();
		return $response->withRedirect($this->router->pathFor('bodyweight.table'));
	}
}
