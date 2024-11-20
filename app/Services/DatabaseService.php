<?php

namespace App\Services;

use PDO;

class DatabaseService
{
    protected $pdo;

    public function __construct()   
    {
        $this->pdo = new PDO(
            env('DB_CONNECTION').':host='.env('DB_HOST').';dbname='.env('DB_DATABASE'),
            env('DB_USERNAME'),
            env('DB_PASSWORD')
        );
    }

    public function query($query, $params = [])
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }
}
