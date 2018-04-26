<?php
use Carbon\Middleware\AuthMiddleware;

$app->group('', function() {
	$this->group('/', function() {
		$this->get('home', 'DashboardController:index')->setName('home');
		$this->post('verify', 'DashboardController:verify');
		$this->get('logout', 'DashboardController:logout');
		$this->get('createAccount', 'DashboardController:newUser');
		$this->get('reset', 'DashboardController:reset');
		$this->get('resetPassword', 'UserController:resetPassword');
	});

	$this->group('/lifts', function() {
		//app pages
		$this->get('/view/asTable', 'LiftController:showLiftTable');
		$this->post('/addLift', 'LiftController:postLift')->setName('lift.post');
		$this->get('/deleteLift/{id}', 'LiftController:deleteLiftFromTable');
	});

	$this->group('/bodyweights', function() {
		//app pages
		$this->get('/view/asTable', 'BodyweightController:showBodyweightTable');
		$this->post('/addBodyweight', 'BodyweightController:postBodyweight')->setName('bodyweight.post');
		$this->get('/deleteBodyweight/{id}', 'BodyweightController:deleteBodyweightFromTable');
	});

	$this->group('/lifttypes', function() {
		//app pages
		//probably none
	});

	$this->group('/foods', function() {
		$this->get('/{id}', 'FoodController:getFoods');
		$this->post('/search', 'FoodController:searchFoods');
		$this->get('/addFoodToHistory/{id}', 'FoodController:addFoodtoHistory');
	});

	$this->group('/users', function() {
		$this->post('/checkLogin', 'UserController:checkLogin');
		$this->post('/addUser', 'UserController:addUser');
	});
})->add(new AuthMiddleware($container));

$app->get('/login', 'AuthController:getSignIn')->setName('auth.signin');
$app->post('/login', 'AuthController:postSignIn')->setName('auth.signin');

$app->group('/api', function() {
	$this->group('/lifts', function() {
		$this->get('/{id}', 'LiftController:getLifts');
		$this->post('/', 'LiftController:postLift');
		$this->delete('/', 'LiftController:deleteLift');
	});
	$this->group('/bodyweights', function() {
		$this->get('/{id}', 'BodyweightController:getBodyweights');
		$this->post('/', 'BodyweightController:postBodyweight');
		$this->delete('/', 'BodyweightController:deleteBodyweight');
	});
	$this->group('/lifttypes', function() {
		$this->get('/{id}', 'LifttypesController:getLifttypes');
		$this->post('/', 'LifttypesController:postLiftType');
	});
	$this->group('/foods', function() {
		$this->get('/{id}', 'FoodController:getFoods');
		$this->get('/search/{query}', 'FoodController:searchFoods');
		//todo when nutrition api is up
	});
	$this->group('/users', function() {
		$this->post('/', 'UserController:postUser');
	});


});
