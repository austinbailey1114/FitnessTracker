<?php

namespace Carbon\Controllers;

class UserController extends Controller {
	//api
	public function checkLogin($request, $response) {

		$args = $request->getParsedBody();
		$query = new Query();

		$result = $query->table('users')->select(array('id', 'name'))->where('username', '=', $args['username'])->and_where('password', '=', md5($args['password']))->execute();

		if (count($result > 0)) {
			return $response->withJson($result, 200, JSON_PRETTY_PRINT);
		}
	}

	public function postUser($request, $response) {
		$data = $request->getParsedBody();

		$query = new Query();
		$result = $query->table('users')
						->insert(array('name', 'username', 'password'), array($data['name'], $data['username'], md5($data['password'])))
						->execute();

		if ($result) {
			echo "User created successfully";
			return $response->withStatus(200);
		} else {
			echo "Unable to add user. Please check that variables are properly defined";
			return $reponse->withStatus(400);
		}
	}

	//app pages
	public function addUser($request, $response) {
		$data = $request->getParsedBody();

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, getenv('URL') . 'api/users/');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$result = curl_exec($ch);

		var_dump($result);

		if ($result) {
			$query = new Query();
			$userData = $query->table('users')->select(array('id', 'name'))->where('username', '=', $data['username'])->and_where('password', '=', md5($data['password']))->execute();
			$_SESSION['id'] = $userData[0]['id'];
			$_SESSION['name'] = $userData[0]['name'];
			$_SESSION['created'] = time();
			return $response->withHeader('Location', '../');
		}
	}

	public function resetPassword($request, $response) {
		$query = new Query();

		//uncomment following lines when uploaded to server
		/*
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$newPass = '';
		for ($i=0; $i < 8; $i++) { 
			$newPass = $newPass . $chars[random_int(0, strlen($chars))];
		}

		$result = $query->table('users')->update(array('password'), array(md5($newPass)))->where('id', '=', $_SESSION['id'])->execute();
		
		if ($result) {
			$to      = $_SESSION['email'];
			$subject = 'Password Reset';
			$message = 'Your new password is: ' . $newPass;
			$headers = 'From: liftappsite@austinmbailey.com';

			mail($to, $subject, $message, $headers);
		}*/

		return $response->withHeader('Location', './');
	}
}