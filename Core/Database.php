<?php

declare(strict_types=1);

namespace Core;

use PDO;

class Database
{
    public $connection;
    public $statement;

    public function __construct($config, $username = 'MYSQL_USER', $password = 'MYSQL_PASSWORD')
    {
        // $dsn = 'mysql:' . http_build_query($config, '', ';');
        $dsn = 'mysql:host=db;dbname=MYSQL_DATABASE';

        $this->connection = new PDO($dsn, $username, $password, [
           PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

        // dd($this->connection);
        
    }

    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);

        $this->statement->execute($params);

        return $this;
    }

    public function get()
    {
        return $this->statement->fetchAll();
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();

        if (! $result) {
            abort();
        }

        return $result;
    }
}
