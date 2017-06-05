<?php  
error_reporting(E_ALL);
include_once '../autoload.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
/*
/reservation
	->GET:show all
	->POST: add new
	->PUT: denied
	->DELETE: denied

/reservation/:id
	->GET: show id model
	->POST: denied
	->PUT: update the model
	->DELETE: delete the model

*/

$routes = [];
$routes['/reservation/:id'] = [
	'GET'=>[
		'controller'=>'lib\modules\reservation\Controller',
		'methode'=>'GetById'
	]
];
$routes['/reservation'] = [
	'POST'=>[
		'controller'=>'lib\modules\reservation\Controller',
		'methode'=>'Post'
	],
	'GET'=>[
		'controller'=>'lib\modules\reservation\Controller',
		'methode'=>'Get'
	]
];
$routes['/room'] = [
	'GET'=>[
		'controller'=>'lib\modules\room\Controller',
		'methode'=>'Get'
	]
];
$routes['/room/:id'] = [
	'GET'=>[
		'controller'=>'lib\modules\room\Controller',
		'methode'=>'GetById'
	]
];

// REQUEST_METHOD
// REQUEST_URI

try{
	$DB = lib\Core\Database::getDB(
		array(
	        'MYSQL_HOST'=>'172.17.0.2',
	        'MYSQL_DATABASE'=>'hbwa',
	        'MYSQL_USER'=>'hbwa',
	        'MYSQL_PASSWORD'=>'test'
		)
	);
	$APIController = new  lib\Core\API($DB);
	$APIController->setRoutes($routes);
	$APIController->setRequestMethode($_SERVER['REQUEST_METHOD']);
	$APIController->parseUrl($_SERVER['REQUEST_URI']);
	$result = $APIController->callController();

	echo json_encode($result);

} catch ( Exception $e) {
	echo json_encode($err);
}


try {
	// $DB = lib\core\Database::getDB(
	// 	array(
	//            'MYSQL_HOST'=>'172.17.0.2',
	//            'MYSQL_DATABASE'=>'hbwa',
	//            'MYSQL_USER'=>'hbwa',
	//            'MYSQL_PASSWORD'=>'test'
	//    	)
	//    );
	// $Controller = new lib\modules\reservation\Controller($DB);
	// $Controller->validate($_POST);
	// echo json_encode($Controller->processFormData());
} catch ( Exception $err) {
	echo json_encode($err);
}
