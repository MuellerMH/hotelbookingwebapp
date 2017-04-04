<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use lib\generic\Controller as Controller;

/**
 * @covers \lib\module\room\Model
 */
final class ControllerTest extends TestCase
{
    private $testObject;

    public function testCreateController()
    {
        $this->testObject = new Controller();
        $this->assertEquals('lib\generic\controller', get_class($this->testObject));
    }
}
