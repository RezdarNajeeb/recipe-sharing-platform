<?php

namespace Core;

use PDO;
use PDOStatement;

class Database
{
    private PDO $connection;
    private bool|PDOStatement $statement;
    public function __construct()
    {
        $dsn = "{$_ENV['DB_TYPE']}:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_NAME']};charset={$_ENV['DB_CHARSET']}";

        $this->connection = new PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query(string $query): Database
    {
        $this->statement = $this->connection->prepare($query);

        $this->statement->execute();

        return $this;
    }

    public function all(): array
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

        if (!$result) {
            echo "No records found";
        }

        return $result;
    }
}