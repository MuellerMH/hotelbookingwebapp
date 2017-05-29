<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use \lib\modules\reservation\Controller;
use \lib\Core\Database;
use \lib\Core\API;

/**
* @covers API - index.php;
*/
final class ApiTest extends TestCase
{
	public function testAPIPostForm() {
		// simulate $_POST;
		$POST = [];
		$POST['arrival'] = \date('Y-m-d');
		$POST['departure'] = \date('Y-m-d');
		$POST['currency'] = 'EUR';
		$POST['total_price'] = 99.97;
		
		$DB = Database::getDB(
			array(
                'MYSQL_HOST'=>'172.17.0.2',
                'MYSQL_DATABASE'=>'hbwa',
                'MYSQL_USER'=>'hbwa',
                'MYSQL_PASSWORD'=>'test'
        	)
        );

		$Controller = new Controller($DB);
		$this->assertEquals(get_class($Controller),'lib\modules\reservation\Controller');
		// and validate the user data
		$Controller->validate($POST);
		// call a function with User data to create the model and maybe save it.
		$Model = $Controller->processFormData();
		$Model->save();
		$this->assertEquals(get_class($Model),'lib\modules\reservation\Model');
		$this->assertObjectHasAttribute('id',$Model);
		$this->assertGreaterThan(0,$Model->getId());
	}

	public function testSetRequestMethod() {
		$simulateSERVER['REQUEST_URI'] = '/reservation/1';
		$simulateSERVER['REQUEST_METHOD'] = 'GET';
		$DB = Database::getDB(
			array(
                'MYSQL_HOST'=>'172.17.0.2',
                'MYSQL_DATABASE'=>'hbwa',
                'MYSQL_USER'=>'hbwa',
                'MYSQL_PASSWORD'=>'test'
        	)
        );
        
		$APIController = new API($DB);
		$APIController->setRequestMethode($simulateSERVER['REQUEST_METHOD']);
		$result = $APIController->getRequestMethode();
		$this->assertEquals('GET',$result);
	}

	public function testParseURL() {
		$simulateSERVER['REQUEST_URI'] = '/reservation';
		$simulateSERVER['REQUEST_METHOD'] = 'GET';
		$DB = Database::getDB(
			array(
                'MYSQL_HOST'=>'172.17.0.2',
                'MYSQL_DATABASE'=>'hbwa',
                'MYSQL_USER'=>'hbwa',
                'MYSQL_PASSWORD'=>'test'
        	)
        );
        
		$routes['/reservation/:id'] = [
			'POST'=>[
				'controller'=>'lib\modules\reservation\Controller',
				'methode'=>'Post'
			],
			'GET'=>[
				'controller'=>'lib\modules\reservation\Controller',
				'methode'=>'GetById'
			]
		];
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
		$APIController = new API($DB);
		$APIController->setRoutes($routes);
		$APIController->setRequestMethode("GET");
		$result = $APIController->parseUrl($simulateSERVER['REQUEST_URI']);
		$this->assertEquals('/reservation',$result);
	}

	public function testParseURLWithPlaceHolder() {
		$simulateSERVER['REQUEST_URI'] = '/reservation/123';
		$simulateSERVER['REQUEST_METHOD'] = 'GET';
		$DB = Database::getDB(
			array(
                'MYSQL_HOST'=>'172.17.0.2',
                'MYSQL_DATABASE'=>'hbwa',
                'MYSQL_USER'=>'hbwa',
                'MYSQL_PASSWORD'=>'test'
        	)
        );
        
		$routes['/reservation/:id'] = [
			'POST'=>[
				'controller'=>'lib\modules\reservation\Controller',
				'methode'=>'Post'
			],
			'GET'=>[
				'controller'=>'lib\modules\reservation\Controller',
				'methode'=>'GetById'
			]
		];
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
		$APIController = new API($DB);
		$APIController->setRoutes($routes);
		$APIController->setRequestMethode($simulateSERVER['REQUEST_METHOD']);
		$result = $APIController->parseUrl($simulateSERVER['REQUEST_URI']);
		$this->assertEquals('/reservation/:id',$result);
	}

	public function testLoadController() {
		$simulateSERVER['REQUEST_URI'] = '/reservation/1';
		$simulateSERVER['REQUEST_METHOD'] = 'GET';

		$DB = Database::getDB(
			array(
                'MYSQL_HOST'=>'172.17.0.2',
                'MYSQL_DATABASE'=>'hbwa',
                'MYSQL_USER'=>'hbwa',
                'MYSQL_PASSWORD'=>'test'
        	)
        );
		$routes['/reservation/:id'] = [
			'POST'=>[
				'controller'=>'lib\modules\reservation\Controller',
				'methode'=>'Post'
			],
			'GET'=>[
				'controller'=>'lib\modules\reservation\Controller',
				'methode'=>'GetById'
			]
		];
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
		$APIController = new API($DB);
		$APIController->setRoutes($routes);
		$APIController->setRequestMethode($simulateSERVER['REQUEST_METHOD']);
		$APIController->parseUrl($simulateSERVER['REQUEST_URI']);
		$result = $APIController->getController();
		$this->assertEquals(get_class($result),'lib\modules\reservation\Controller');
	}

	public function testCallControllerMethod(){
		$simulateSERVER['REQUEST_URI'] = '/reservation';
		$simulateSERVER['REQUEST_METHOD'] = 'GET';
		$DB = Database::getDB(
			array(
                'MYSQL_HOST'=>'172.17.0.2',
                'MYSQL_DATABASE'=>'hbwa',
                'MYSQL_USER'=>'hbwa',
                'MYSQL_PASSWORD'=>'test'
        	)
        );
        
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
		$APIController = new API($DB);
		$APIController->setRoutes($routes);
		$APIController->setRequestMethode($simulateSERVER['REQUEST_METHOD']);
		$APIController->parseUrl($simulateSERVER['REQUEST_URI']);
		$Controller = $APIController->getController();
		$this->assertEquals(true,method_exists($Controller,"actionGet"));

	}

	public function testSetRoutes()
	{
		$simulateSERVER['REQUEST_URI'] = '/reservation';
		$simulateSERVER['REQUEST_METHOD'] = 'GET';
		$DB = Database::getDB(
			array(
                'MYSQL_HOST'=>'172.17.0.2',
                'MYSQL_DATABASE'=>'hbwa',
                'MYSQL_USER'=>'hbwa',
                'MYSQL_PASSWORD'=>'test'
        	)
        );
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
		$APIController = new API($DB);
		$APIController->setRoutes($routes);
		$APIController->setRequestMethode($simulateSERVER['REQUEST_METHOD']);
		$result = $APIController->getRoute($simulateSERVER['REQUEST_URI']);
		
		$result = $result[$simulateSERVER['REQUEST_METHOD']]['method'];
		$this->assertEquals(ucfirst($result), ucfirst('Get'));
	}

	public function testaddRoute()
	{
		$simulateSERVER['REQUEST_URI'] = '/reservation';
		$simulateSERVER['REQUEST_METHOD'] = 'GET';
		$DB = Database::getDB(
			array(
                'MYSQL_HOST'=>'172.17.0.2',
                'MYSQL_DATABASE'=>'hbwa',
                'MYSQL_USER'=>'hbwa',
                'MYSQL_PASSWORD'=>'test'
        	)
        );
		$APIController = new API($DB);
		$requestType="GET";
		$stringURI="/reservation";
		$controller="lib\modules}reservation\Controller";
		$methode="Get";
		$APIController->addRoute($requestType,$stringURI,$controller,$methode);
		$result = $APIController->getRoute($simulateSERVER['REQUEST_URI']);
		$result = $result[$simulateSERVER['REQUEST_METHOD']]['method'];
		$this->assertEquals(ucfirst($result), ucfirst('Get'));
	}

	public function testRexResult() {
		$simulateSERVER['REQUEST_URI'] = '/bookinguser/123';
		$simulateSERVER['REQUEST_METHOD'] = 'GET';
		$DB = Database::getDB(
			array(
                'MYSQL_HOST'=>'172.17.0.2',
                'MYSQL_DATABASE'=>'hbwa',
                'MYSQL_USER'=>'hbwa',
                'MYSQL_PASSWORD'=>'test'
        	)
        );
        
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
		$APIController = new API($DB);
		$APIController->setRoutes($routes);
		$APIController->parseUrl($simulateSERVER['REQUEST_URI']);
		$result = $APIController->getRegExResult($simulateSERVER['REQUEST_URI']);
		$this->assertEquals('123',$result[2]);
		$this->assertEquals('bookinguser',$result[1]);
	}
}