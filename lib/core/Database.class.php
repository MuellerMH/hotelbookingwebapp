<?php
namespace lib\Core;


class Database
{
    static $db=NULL;
    static $config;
    private $connection;
    private $stmt;

    private function __construct($host, $dbName, $user, $password)
    {
        $this->connection = new \PDO("mysql:host=$host;port=3306;dbname=$dbName",$user,$password, array(
            \PDO::ATTR_EMULATE_PREPARES=>false,
            \PDO::MYSQL_ATTR_DIRECT_QUERY=>false,
            \PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION
        ));
    }
    static function setConfig(array $conf)
    {
        self::$config = $conf;
    }
    static function getDB(array $conf=[])
    {
        if ( !is_object(self::$db) )
        {
            if ( !empty($conf) )
            {
                self::$config = $conf;
            }
            self::$db = new Database(self::$config['MYSQL_HOST'], self::$config['MYSQL_DATABASE'], self::$config['MYSQL_USER'], self::$config['MYSQL_PASSWORD']);
        }

        return self::$db;
    }

    public function query(string $sql)
    {
        $this->stmt = $this->connection->query($sql);
        return $this;
    }

    public function execute(string $sql, array $data)
    {
        $this->stmt = $this->connection->prepare($sql);
        $this->stmt->execute($data);
        return $this;
    }

    public function fetch()
    {
        return $this->stmt->fetch();
    }

    public function fetchAll()
    {
        return $this->stmt->fetchAll();
    }

    public function getError()
    {
        return $this->connection->errorInfo();
    }

    public function getInsertID()
    {
        return $this->connection->lastInsertId();
    }
}