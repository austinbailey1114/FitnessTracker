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
			'host' => getenv('DB_HOST'),
			'database' => getenv('DB_NAME'),
			'username' => getenv('DB_USER'),
			'password' => getenv('DB_PASS'),
			'collation' => 'latin1_swedish_ci',
			'prefix' => ''
		]
	]
]);

$container = $app->getContainer();
//set up eloquent
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();
//Add Db to container
$container['db'] = function ($container) use ($capsule) {
	return $capsule;
};

$container['auth'] = function($container) {
	return new \Carbon\Auth\Auth;
};

$container['view'] = function ($container) {
	$view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
		'cache' => false
	]);
	$view->addExtension(new \Slim\Views\TwigExtension(
		$container->router,
		$container->request->getUri()
	));
	$view->getEnvironment()->addGlobal('auth', [
		'check' => $container->auth->check(),
		'user' => $container->auth->user()
	]);
	return $view;
};

$container['LiftController'] = function($container) {
	return new \Carbon\Controllers\LiftController($container);
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
