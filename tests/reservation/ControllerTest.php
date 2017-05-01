<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use lib\modules\reservation\Controller;
use lib\core\Database;
/**
* @covers \lib\modules\reservation\Controller;
*/
final class ControllerTest extends TestCase
{

	
	public function testAPIPostForm() {
		// simulate $_POST;
		$POST = [];
		$POST['arrival'] = "2017-05-01";
		$POST['departure'] = "2017-05-02";
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
}