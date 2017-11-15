<?php

namespace Community\Framework;

class Database
{
    private static $db;
    private static $config;

    public static function setConfig($config)
    {
        self::$config = $config;
    }

    public static function getDB()
    {
        if(!self::$db)
        {
            try {
                self::$db = new \PDO(
                    "mysql:host=" . self::$config['dbhost']
                    . ";dbname=" . self::$config['dbname']
                    .";charset=utf8", self::$config['dbuser'],
                    self::$config['dbpass']
                );
            }
            catch (\PDOException $e) {
                die("Error connecting to DB: " . $e->getMessage());
            }
        }
        return self::$db;
    }
}
