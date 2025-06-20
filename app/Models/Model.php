<?php

namespace App\Models;

use Core\Database;
use PDOStatement;

class Model
{
    private static bool|PDOStatement $statement;
    protected static string $table;

    public function __construct()
    {
        //
    }

    public static function query(string $query, array $params = []): Model
    {
        static::$statement = new Database()::$pdo->prepare($query);

        static::$statement->execute($params);

        return new static;
    }

    public static function all(): array
    {
        static::query("SELECT * FROM ".static::$table);
        return static::$statement->fetchAll();
    }

    public static function find(int $id): mixed
    {
        static::query("SELECT * FROM " . static::$table . " WHERE id=:id", [
            'id' => $id
        ]);
        return static::$statement->fetch();
    }

    public static function findOrFail(int $id): mixed
    {
        $result = static::find($id);

        if (!$result) {
            echo "No records found";
        }

        return $result;
    }
}