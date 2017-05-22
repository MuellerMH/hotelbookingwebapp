<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use \lib\modules\room\Model;
use \lib\Core\Database;

/**
* @covers API - index.php;
*/
final class ModelTest extends TestCase
{
	public function testInit(){
		$this->assertEquals(true,false);
	}
}