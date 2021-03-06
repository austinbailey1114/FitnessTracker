<?php
use Carbon\Middleware\AuthMiddleware;
use Carbon\Middleware\APIMiddleware;

$app->group('', function() {
	$this->get('/home', 'DashboardController:index')->setName('home');
	$this->post('/verify', 'DashboardController:verify');
	$this->get('/logout', 'DashboardController:logout')->setName('logout');
	$this->get('/createAccount', 'DashboardController:newUser');

	$this->group('/lifts', function() {
		$this->get('/table', 'LiftController:showLiftTable')->setName('lift.table');
		$this->post('/addLift', 'LiftController:postLift')->setName('lift.post');
		$this->get('/delete/{id}', 'LiftController:deleteLiftFromTable')->setName('lift.delete');
	});

	$this->group('/bodyweights', function() {
		$this->get('/table', 'BodyweightController:showBodyweightTable')->setName('bodyweight.table');
		$this->post('/addBodyweight', 'BodyweightController:postBodyweight')->setName('bodyweight.post');
		$this->get('/delete/{id}', 'BodyweightController:deleteBodyweightFromTable')->setName('bodyweight.delete');
	});

	$this->group('/lifttypes', function() {
	});

	$this->group('/foods', function() {
		$this->get('/{id}', 'FoodController:getFoods');
		$this->post('/search', 'FoodController:searchFoods');
		$this->get('/addFoodToHistory/{id}', 'FoodController:addFoodtoHistory');
	});
})->add(new AuthMiddleware($container));

$app->get('/login', 'AuthController:getSignIn')->setName('auth.signin');
$app->post('/login', 'AuthController:postSignIn')->setName('auth.signin');

$app->group('/api', function() {

	$this->group('/auth', function() {
		$this->post('/signin', 'APIController:postAuth');
	});

	$this->group('/lifts', function() {
		$this->get('/{id}', 'APIController:getLift');
	});

	$this->group('/bodyweights', function() {
		$this->get('/{id}', 'APIController:getBodyweight');
	});

	$this->group('/lifttypes', function() {
		$this->get('/{id}', 'APIController:getLifttypes');
	});

	$this->group('/foods', function() {
		$this->get('/{id}', 'FoodController:getFoods');
	});

	$this->group('/users', function() {
		$this->post('/', 'UserController:postUser');
	});

	$this->group('/foods', function() {
		$this->get('/goals/{id}', 'APIController:getFoodGoals');
	});
});

$app->group('/api', function() {
	$this->group('/lifts', function() {
		$this->post('/', 'APIController:postLift');
		$this->delete('/', 'APIController:deleteLift');
	});
	$this->group('/bodyweights', function() {
		$this->post('/', 'APIController:postBodyweight');
		$this->delete('/', 'APIController:deleteBodyweight');
	});
	$this->group('/lifttypes', function() {
		$this->post('/', 'LifttypesController:postLiftType');
	});
	$this->group('/foods', function() {
		$this->get('/search/{query}', 'FoodController:searchFoods');
		//todo when nutrition api is up
		$this->post('/goals/', 'APIController:postFoodGoals');
	});
})->add(new APIMiddleware($container));
