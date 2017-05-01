<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use \lib\modules\reservation\Dal;
use \lib\modules\reservation\Model;
use \lib\core\Database;

/**
* @covers \lib\modules\reservation\Model;
*/
final class DalTest extends TestCase
{

    private $idIndex=[];
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
        $POST = [];
        $POST['arrival'] = new \DateTime("2017-05-01");
        $POST['departure'] = new \DateTime("2017-05-02");
        $POST['currency'] = 'EUR';
        $POST['total_price'] = 99.97;

        $DAL = new Dal($DB);
        $rawData = $DAL->save(new Model($POST,$DAL));
        array_push($this->idIndex, $DAL->getInsertID());
        $this->assertGreaterThan(0,$DAL->getInsertID());
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