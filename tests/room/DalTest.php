<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use \lib\modules\room\Dal;
use \lib\modules\room\Model;
use \lib\Core\Database;

/**
* @covers API - index.php;
*/
final class DalTest extends TestCase
{
	

    private $idIndex=[];


    public function testSave()
    {
        $DB = Database::getDB(
            array(
                'MYSQL_HOST'=>'172.17.0.2',
                'MYSQL_DATABASE'=>'hbwa',
                'MYSQL_USER'=>'hbwa',
                'MYSQL_PASSWORD'=>'test'
            )
        );
       $simulatePostData = array(
			'label'=>"Test label",
			'description'=>"Test Description",
			'occmin'=>1,
			'occmax'=>2,
			'breakfast'=>false
		);

        $DAL = new Dal($DB);
        $Model = new Model($simulatePostData,$DAL);
        $rawData = $DAL->save($Model);
        $index = $DAL->getInsertID();
        array_push($this->idIndex,$index );
        $this->assertGreaterThan(0,$index );
    }

    public function testGetById()
    {
        $DB = Database::getDB(
            array(
                'MYSQL_HOST'=>'172.17.0.2',
                'MYSQL_DATABASE'=>'hbwa',
                'MYSQL_USER'=>'hbwa',
                'MYSQL_PASSWORD'=>'test'
            )
        );

        $DAL = new Dal($DB);
        $rawData = $DAL->getById(1);

        $this->assertEquals(true,is_array($rawData));
        $this->assertEquals(false,empty($rawData));

    }

    public function testGetAll()
    {
        $DB = Database::getDB(
            array(
                'MYSQL_HOST'=>'172.17.0.2',
                'MYSQL_DATABASE'=>'hbwa',
                'MYSQL_USER'=>'hbwa',
                'MYSQL_PASSWORD'=>'test'
            )
        );

        $DAL = new Dal($DB);
        $rawData = $DAL->getAll();

        $this->assertEquals(true,is_array($rawData));
        $this->assertEquals(false,empty($rawData));
        $this->assertGreaterThan(1,count($rawData));
    }

    public function testDelete()
    {
       $DB = Database::getDB(
            array(
                'MYSQL_HOST'=>'172.17.0.2',
                'MYSQL_DATABASE'=>'hbwa',
                'MYSQL_USER'=>'hbwa',
                'MYSQL_PASSWORD'=>'test'
            )
        );

        $DAL = new Dal($DB);
        foreach( $this->idIndex as $id) {
            $DAL->delete($id);   

            $rawData = $DAL->getById($id);    
            $this->assertEquals(true,empty($rawData));     
        }
    }
}