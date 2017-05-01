<?php  
error_reporting(E_ALL);
include_once '../autoload.php';
header('Content-Type: application/json');
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
	->DELETE: delete the mode

*/

$routes = [];
$routes['/reservation'] = [
	'POST'=>[
		'controller'=>'lib\modules\reservation\Controller',
		'method'=>'Post'
	],
	'GET'=>[
		'controller'=>'lib\modules\reservation\Controller',
		'method'=>'Get'
	]
];
// REQUEST_METHOD
// REQUEST_URI



$DB = lib\Core\Database::getDB(
	array(
        'MYSQL_HOST'=>'172.17.0.2',
        'MYSQL_DATABASE'=>'hbwa',
        'MYSQL_USER'=>'hbwa',
        'MYSQL_PASSWORD'=>'test'
	)
);
try{
	if ( empty($routes[$_SERVER['REQUEST_URI']]) || empty($routes[$_SERVER['REQUEST_URI']][$_SERVER['REQUEST_METHOD']]))
		echo json_encode("not yet implemented say bye bey and have nice day");


	$controllerName = $routes[$_SERVER['REQUEST_URI']][$_SERVER['REQUEST_METHOD']]['controller'];
	$controllerMethod = 'action'.ucFirst($routes[$_SERVER['REQUEST_URI']][$_SERVER['REQUEST_METHOD']]['method']); 

	$Controller = new $controllerName ( $DB );
	$result = $Controller->{$controllerMethod}();

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
