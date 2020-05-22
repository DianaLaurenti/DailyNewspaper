<?php
declare(strict_types=1);

namespace DailyNewspaper\Model;

use PDO;

class DbClass
{
    protected static PDO $pdo;

    public function __construct(PDO $pdo)
    {
        self::$pdo = $pdo;
    }

    public static function getOne($id) {
        return null;
    }
    public static function getAll(bool $params) : array{
        return [];
    }
    public static function createOne($obj) : bool{
        return false;
    }
    public static function deleteOne($id) : bool{
        return false;
    }
    public static function updateOne($obj) : bool{
        return false;
    }
}