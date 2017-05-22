<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use \lib\modules\room\Controller;
use \lib\Core\Database;

/**
* @covers API - index.php;
*/
final class ControllerTest extends TestCase
{

	public function testValidateRoomPost(){
		$DB = Database::getDB(
			array(
                'MYSQL_HOST'=>'172.17.0.2',
                'MYSQL_DATABASE'=>'hbwa',
                'MYSQL_USER'=>'hbwa',
                'MYSQL_PASSWORD'=>'test'
        	)
        );		
        $Controller = new Controller($DB);
		$this->assertEquals(true,false);
	}

	public function testSaveRoom(){
		$this->assertEquals(true,false);
	}

	public function testActionGet(){
		$DB = Database::getDB(
			array(
                'MYSQL_HOST'=>'172.17.0.2',
                'MYSQL_DATABASE'=>'hbwa',
                'MYSQL_USER'=>'hbwa',
                'MYSQL_PASSWORD'=>'test'
        	)
        );
		$Controller = new Controller($DB);
		$resultArray = $Controller->actionGet();
		$this->assertGreaterThan(-1,count($resultArray));
	}

	public function testActionPost(){
		$simulatePostData = array(
			'label'=>"Test label",
			'description'=>"Test Description",
			'occmin'=>1,
			'occmax'=>2,
			'breakfast'=>false
		);

		$DB = Database::getDB(
			array(
                'MYSQL_HOST'=>'172.17.0.2',
                'MYSQL_DATABASE'=>'hbwa',
                'MYSQL_USER'=>'hbwa',
                'MYSQL_PASSWORD'=>'test'
        	)
        );
		$Controller = new Controller($DB);
		$result = $Controller->actionPost($simulatePostData);
		$this->assertEquals(false,\is_array($result));
	}

	public function testActionDelete(){
		$DB = Database::getDB(
			array(
                'MYSQL_HOST'=>'172.17.0.2',
                'MYSQL_DATABASE'=>'hbwa',
                'MYSQL_USER'=>'hbwa',
                'MYSQL_PASSWORD'=>'test'
        	)
        );
		$Controller = new Controller($DB);
		$resultArray = $Controller->actionDelete(1);
		$this->assertEquals(true,false);
	}

	public function testActionGetById(){

		$DB = Database::getDB(
			array(
                'MYSQL_HOST'=>'172.17.0.2',
                'MYSQL_DATABASE'=>'hbwa',
                'MYSQL_USER'=>'hbwa',
                'MYSQL_PASSWORD'=>'test'
        	)
        );
		$Controller = new Controller($DB);
		$resultArray = $Controller->actionGetById(1);
		$this->assertGreaterThan(-1,count($resultArray));
	}
}