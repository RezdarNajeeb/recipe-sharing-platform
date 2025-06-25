<?php

namespace App\Models;

use Core\App;
use Core\Database;
use PDO;
use PDOStatement;

class Model
{
    private static bool|PDOStatement $statement;
    protected static string $table;
    protected static PDO $db;

    public function __construct()
    {
        self::$db = App::resolve(Database::class);
    }

    public static function query(string $query, array $params = []): bool
    {
        static::$statement = new static()::$db->prepare($query);

        return static::$statement->execute($params);
    }

    public static function all(array $relations = []): array
    {
        $table = static::getTableName();

        $selectFields = [];
        $joins = [];
        $relationTables = [];

        // Get columns of the base table
        static::query("SHOW COLUMNS FROM $table");
        $baseColumns = array_column(static::$statement->fetchAll(PDO::FETCH_ASSOC), 'Field');

        // Add base table fields with aliases
        foreach ($baseColumns as $col) {
            $selectFields[] = "$table.$col AS {$table}__$col";
        }

        // Add relation fields
        if (!empty($relations)) {
            foreach ($relations as $relation) {
                if (str_ends_with($relation, 'y')) {
                    $relationTable = str_replace('y', 'ies', $relation);
                } else {
                    $relationTable = $relation.'s';
                }

                $relationTables[$relation] = $relationTable;

                $joins[] = "LEFT JOIN $relationTable ON $table.{$relation}_id = $relationTable.id";

                // Get columns of the related table
                static::query("SHOW COLUMNS FROM $relationTable");
                $columns = static::$statement->fetchAll(PDO::FETCH_ASSOC);

                foreach ($columns as $col) {
                    $colName = $col['Field'];
                    $selectFields[] = "$relationTable.$colName AS {$relation}__$colName";
                }
            }
        }

        $selectClause = implode(', ', $selectFields);
        $joinClause = implode(' ', $joins);

        $query = "SELECT $selectClause FROM $table $joinClause";
        static::query($query);
        $rows = static::$statement->fetchAll(PDO::FETCH_ASSOC);

        $result = [];

        foreach ($rows as $row) {
            $entry = [];
            $relationsData = [];

            foreach ($row as $key => $value) {
                if (str_starts_with($key, $table . '__')) {
                    $field = substr($key, strlen($table . '__'));
                    $entry[$field] = $value;
                } else {
                    foreach ($relationTables as $relation => $relationTable) {
                        if (str_starts_with($key, $relation . '__')) {
                            $field = substr($key, strlen($relation . '__'));
                            $relationsData[$relation][$field] = $value;
                            break;
                        }
                    }
                }
            }

            // Attach nested relations
            foreach ($relationsData as $relation => $data) {
                $entry[$relation] = $data;
            }

            $result[] = $entry;
        }

        return $result;
    }

    public static function find(int $id): mixed
    {
        static::where('id', $id);

        return static::$statement->fetch();
    }

    public static function findOrFail(int $id): mixed
    {
        $result = static::find($id);

        if (!$result) {
            http_response_code(404);
            echo "No records found";
        }

        return $result;
    }

    public static function where(string $column, string $value, string $operator = '='): static
    {
        static::query("SELECT * FROM " . static::getTableName() . " WHERE $column $operator ?", [$value]);

        return new static();
    }

    public static function getTableName(): string
    {
        $modelName = strtolower(basename(static::class));

        return static::$table ?? str_ends_with($modelName, 'y') ? str_replace('y', 'ies', $modelName) : $modelName.'s';
    }

    public function get(?string $field = null): mixed
    {
        $result = static::$statement->fetch();

        if ($field === null) {
            return $result;
        }

        return $result[$field];
    }

    public static function create(array $fields): bool
    {
        $columns = self::getColumns($fields);
        $wilds = self::getWilds($fields);

        return static::query("INSERT INTO " . static::getTableName() . " ($columns) VALUES($wilds)", array_values($fields));
    }

    public static function update(array $fields): bool
    {
        // col1 = val1, col2 = val2
        $columns = str_replace(',', '=?,', static::getColumns($fields));

        $fields['id'] = $_POST['id'];

        return static::query("UPDATE " . static::getTableName() . " SET $columns=? WHERE id=?", array_values($fields));
    }

    public static function delete(): bool
    {
        return static::query("DELETE FROM " . static::getTableName() . " WHERE id=?", [$_POST['id']]);
    }

    private static function getColumns(array $fields): string
    {
        return implode(',', array_keys($fields));
    }

    private static function getWilds(array $fields): string
    {
        return substr(str_repeat('?,', count($fields)), 0, (count($fields) * 2) - 1);
    }
}