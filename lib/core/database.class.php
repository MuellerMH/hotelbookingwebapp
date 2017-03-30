<?php
namespace lib\core;
class Database {
	// PDO
	static private $connection=NULL;
	private $PDOObject;
	private $PDOStatementObject;

	private function __construct() {
        $this->PDOObject = new \PDO(
            'mysql:host='.(!empty($_SERVER['MYSQL_HOST'])?:'172.17.0.1').';dbname='.(!empty($_SERVER['MYSQL_DATABASE'])?:'hotelbookingwebapp').';port=3306',
            !empty($_SERVER['MYSQL_USER'])?:'hbwa',
            !empty($_SERVER['MYSQL_PASSWORD'])?:'test'
        );
	}

	static public function getConnection() {
		if ( empty(self::$connection) )
			self::$connection = new Database();
		return self::$connection;
	}

	public function query(string $sql)
    {
        return $this->PDOStatementObject = $this->PDOObject->query($sql);
    }

	public function prepare(string $sql)
	{
        return $this->PDOStatementObject = $this->PDOObject->prepare($sql);
	}

	public function fetch() 
	{
        return $this->PDOStatementObject->fetch();
	}

	public function fetchAll() 
	{
	    $aResult = [];
        while($row = $this->PDOStatementObject->fetch()) {
            array_push($aResult,$row);
        }
        return $aResult;
	}

    public function rowCount()
    {
        return $this->PDOStatementObject->rowCount();
    }

    public function lastInsertId()
    {
        return $this->PDOStatementObject->lastInsertId();
    }


    public function getError()
    {
        return ['queryString'=>$this->PDOStatementObject->queryString,'errorInfo'=>$this->PDOStatementObject->errorInfo()[2],'errno'=>$this->PDOStatementObject->errorInfo()[0]];
    }
}