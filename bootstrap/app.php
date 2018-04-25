<?php

session_start();

require '../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$app = new \Slim\App([
	'settings' => [
		'displayErrorDetails' => true,
		'determineRouteBeforeAppMiddleware' => true,
	    'addContentLengthHeader' => false,
		'db' => [
			'driver' => 'mysql',
			'host' => 'localhost',
			'database' => 'joyce',
			'username' => 'root',
			'password' => '',
			'collation' => 'latin1_swedish_ci',
			'prefix' => ''
		]
	]
]);

$container = $app->getContainer();

$container['LiftController'] = function($container) {
	return new \Carbon\Controllers\LiftController($container);
};

$container['view'] = function ($container) {
    return new \Slim\Views\PhpRenderer('../resources/views/');
};

$container['DashboardController'] = function($container) {
	return new \Carbon\Controllers\DashboardController($container);
};

$container['BodyweightController'] = function($container) {
	return new \Carbon\Controllers\BodyweightController($container);
};

$container['LifttypesController'] = function($container) {
	return new \Carbon\Controllers\LifttypesController($container);
};

$container['FoodController'] = function($container) {
	return new \Carbon\Controllers\FoodController($container);
};

$container['UserController'] = function($container) {
	return new \Carbon\Controllers\UserController($container);
};


require '../app/routes.php';
