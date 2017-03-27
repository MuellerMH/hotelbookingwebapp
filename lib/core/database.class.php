<?php
namespace lib\core;
class Database {
	// PDO
	static private $connection;

	private function __construct() {

	}

	static public function getConnection() {
		if ( empty(self::$connection) )
			self::$connection = new Database();
		return self::$connection;
	}

	public function prepare() 
	{

	}

	public function exec() 
	{

	}

	public function fetch() 
	{

	}

	public function fetchAll() 
	{

	}
}