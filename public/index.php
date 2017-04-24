<?php  
error_reporting(E_ALL);
include_once '../autoload.php';
header('Content-Type: application/json');
try {
	$DB = lib\core\Database::getDB(
		array(
            'MYSQL_HOST'=>'172.17.0.2',
            'MYSQL_DATABASE'=>'hbwa',
            'MYSQL_USER'=>'hbwa',
            'MYSQL_PASSWORD'=>'test'
    	)
    );
	$Controller = new lib\modules\reservation\Controller($DB);
	$Controller->validate($_POST);
	echo json_encode($Controller->processFormData());
} catch ( Exception $err) {
	echo json_encode($err);
}
