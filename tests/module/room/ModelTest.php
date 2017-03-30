<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use lib\module\room\Model as Model;

/**
 * @covers \lib\module\room\Model
 */
final class ModelTest extends TestCase
{
	private $testObject;

 	/**
     * @beforeClass
     */
	public function setupModelObject()
	{
		$this->testObject = new Model();
	}

   public function testCreateEmptyRoomModel()
   {
    	$this->testObject = new Model();
      $this->assertEquals('lib\module\room\Model', get_class($this->testObject));
   } 

	/**
	 * @covers Model::getId
	 */
   public function testModelIdIsEmpty()
   {
   	$this->testObject = new Model();
      $this->assertEquals(true, empty($this->testObject->getId()));
   }

}
