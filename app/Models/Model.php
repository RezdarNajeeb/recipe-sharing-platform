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

    public static function create(array $fields): bool|null
    {
        $columns = self::getColumns($fields);
        $wilds = self::getWilds();

        return static::query("INSERT INTO " . static::$table . " ($columns) VALUES($wilds)", array_values($fields));
    }

    public static function update(array $fields): bool|null
    {
        // col1 = val1, col2 = val2
        $columns = str_replace(',', '=?,', static::getColumns($fields));

        return static::query("UPDATE " . static::$table . " SET $columns=? WHERE id=?", array_values($fields));
    }

    private static function getColumns(array $fields): string
    {
        return implode(',', array_keys($fields));
    }

    public static function getWilds(): string
    {
        return substr(str_repeat('?,', count($_REQUEST)), 0, (count($_REQUEST) * 2) - 1);
    }
}