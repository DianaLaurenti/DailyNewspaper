<?php
declare(strict_types=1);

namespace DailyNewspaper\Model;

use PDO;

class DbClass
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}