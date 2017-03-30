<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use lib\core\Database as Database;

/**
 * @covers \lib\module\room\Model
 */
final class DatabaseTest extends TestCase {

    public function testInitObject()
    {
        $this->testObject = Database::getConnection();
        $this->assertEquals('lib\core\Database',get_class($this->testObject));
    }

    public function testSingleton(){
        $this->testObject = Database::getConnection();
        $this->assertEquals(true, $this->testObject === Database::getConnection() );
    }

    public function testQuery(){
        $this->testObject = Database::getConnection();
        $this->assertEquals('PDOStatement',get_class($this->testObject->query('SHOW TABLES')));
    }

    public function testCreateTable(){
        $this->testObject = Database::getConnection();
        $this->assertEquals('PDOStatement',get_class($this->testObject->query('CREATE TABLE IF NOT EXISTS testPrepare (blob_col BLOB, INDEX(blob_col(10)))')));
    }

    public function testFetch(){
        $this->testObject = Database::getConnection();
        $this->testObject->prepare('SHOW TABLES')->execute();
        $this->assertEquals(true,is_array($this->testObject->fetch()));
    }

    public function testFetchAll(){
        $this->testObject = Database::getConnection();
        $this->testObject->prepare('SHOW TABLES')->execute();
        $this->assertEquals(true,is_array($this->testObject->fetchAll()));
    }

    public function testRowCount(){
        $this->testObject = Database::getConnection();
        $this->testObject->prepare('SHOW TABLES')->execute();
        $this->assertEquals(1,$this->testObject->rowCount());
    }

    public function testError() {
        $this->testObject = Database::getConnection();
        $this->testObject->prepare('SELECT * FROM testPrepare WHERE vlog_col = ?')->execute([1]);
        $this->assertEquals('42S22',$this->testObject->getError()['errno']);
    }

    public function testDropTable() {
        $this->testObject = Database::getConnection();
        $this->assertEquals('PDOStatement',get_class($this->testObject->query('DROP TABLE testPrepare ')));
    }

}