<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use \lib\modules\reservation\Dal;

/**
* @covers API - index.php;
*/
final class ApiTest extends TestCase
{
	public function testAPIPostForm() {
		// simulate $_POST;
		$POST = [];
		$POST['arrival'] = \date('Y-m-d');
		$POST['depature'] = \date('Y-m-d');
		$POST['currency'] = 'EUR';
		$POST['total_price'] = 99.97;

		$this->assertEquals(get_class($Model),'lib\modules\reservation\Model');
		$this->assertObjectHasAttribute($Model,'id');
		$this->assertGreaterThan($Model->getId(),0);
	}
}