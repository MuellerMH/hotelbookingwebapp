<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use \lib\core\Database;

/**
* @covers \lib\core\Database;
*/
final class DatabaseTest extends TestCase
{
    public function testCreateConnection()
    {

        $DB = Database::getDB(
            array(
                'MYSQL_HOST'=>'172.17.0.2',
                'MYSQL_DATABASE'=>'hbwa',
                'MYSQL_USER'=>'hbwa',
                'MYSQL_PASSWORD'=>'test'
        ));
        $this->assertEquals(get_class($DB),'lib\Core\Database');

    }

    public function testPrepareDatabase()
    {
        $DB = Database::getDB();
        $DB->query("INSERT INTO user SET user_name='test', user_pass='test',user_mail='mail'");
        $this->assertEquals($DB->getError()[0],'00000');
    }

    public function testFetch()
    {
        $DB = Database::getDB();
        $result = $DB->execute('SELECT id_user FROM user WHERE user_name =:userName',['userName'=>'test']);
        var_dump($result );
        $this->assertEquals($DB->getError()[0],'00000');
        $this->assertEquals($DB->fetch(),array('id_user'=>1,0 => '1'));
    }

    public function testFetchAll()
    {
        $DB = Database::getDB();
        $result = $DB->execute('SELECT id_user FROM user WHERE user_name =:userName',['userName'=>'test']);
        var_dump($result );
        $this->assertEquals($DB->getError()[0],'00000');
        $this->assertGreaterThan(0,count($DB->FetchAll()));
    }


}