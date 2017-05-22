<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use \lib\modules\media\Model;
use \lib\Core\Database;

/**
* @covers API - index.php;
*/
final class ControllerTest extends TestCase
{
	public function testInit(){
		$this->assertEquals(true,false);
	}
}