<?php
namespace Adapter;

class Database implements DatabaseInterface
{
    private static $instances = [];

    private $pdo;

    private function __construct($host, $user, $pass, $dbName)
    {
        try{
            $this->pdo = new \PDO("mysql:host=$host;dbname=$dbName", $user, $pass,
                array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        } catch (\PDOException $e) {
            echo $e->getCode() . ': ';
            die('Грешка при връзка с DB');
        }

    }

    public function prepare($statement): DatabaseStatementInterface
    {
        return new DatabaseStatement($this->pdo->prepare($statement));
    }

    public static function setInstance($host, $user, $pass, $dbName, $instanceName = 'default')
    {
        self::$instances[$instanceName] = new Database($host, $user, $pass, $dbName);

    }


    public static function getInstance($instanceName = 'default')
    {
        return self::$instances[$instanceName];
    }

}

