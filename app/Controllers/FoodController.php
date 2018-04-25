<?php

namespace Carbon\Controllers;

class FoodController extends Controller {
	//api
	public function getFoods($request, $response, $args) {
		$query = new Query();

		$mydata = $query->table('foods')->where('user', '=', $args['id'])->and_where('date', '>', 'CURDATE()')->execute();

		return $response->withJson($mydata, 200, JSON_PRETTY_PRINT);
	}

	public function addFoodToHistory($request, $response, $args) {
		$query = new Query();

		$url = 'http://localhost/NutritionAPI/public/foods/' . $args['id'];

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

		$data = json_decode(trim(curl_exec($ch)), true)[0];
		curl_close ($ch);

		$query = new Query();
		$result = $query->table('foods')
						->insert(array('name', 'user', 'calories', 'fat', 'carbs', 'protein'),
								 array($data['name'], $_SESSION['id'], $data['calories'], $data['fat'], $data['carbohydrate'], $data['protein']))
						->execute();

		if ($result) {
			$_SESSION['message'] = 'success';
		} else {
			$_SESSION['message'] = 'failed';
		}
		
		return $response->withHeader('Location', '../../');
		
	}

	public function searchFoods($request, $response, $args) {
		return $this->view->render($response, 'search.php');
	}

}