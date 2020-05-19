<?php

namespace DailyNewspaper\Model;

use DailyNewspaper\Config;
use \PDO;
/**
 * SQLite connnection: Singleton
 */
class SQLiteConnection {
    
    private static $pdo;
    
    private function __construct()
    {
        self::$pdo = new PDO("sqlite:" . Config::PATH_TO_SQLITE_FILE);
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function connect() : PDO
    {
        if(!isset(self::$pdo))
        {
            new SQLiteConnection();
        }
        return self::$pdo;
    }
}