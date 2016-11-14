<?php



class Database {

    private static $db;
    private $connection;

    private function __construct() {
        $this->connection = new mysqli("localhost","root","","test");
    }

    function __destruct() {

    }

    public static function getConnection() {
        if (self::$db == null) {
            self::$db = new Database();
        }
        return self::$db->connection;
    }
}

