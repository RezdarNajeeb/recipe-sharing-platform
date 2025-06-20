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

    public static function query(string $query, array $params = []): bool
    {
        static::$statement = new Database()::$pdo->prepare($query);

        return static::$statement->execute($params);
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

    public static function create(array $attributes): bool|null
    {
        $columns = self::getColumns();
        $wilds = self::getWilds();

        return static::query("INSERT INTO " . static::$table . " ($columns) VALUES($wilds)", $attributes);
    }

    private static function getColumns(): string
    {
        return implode(',', array_keys($_REQUEST));
    }

    public static function getWilds(): string
    {
        return substr(str_repeat('?,', count($_REQUEST)), 0, (count($_REQUEST) * 2) - 1);
    }
}