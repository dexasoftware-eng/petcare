<?php

namespace Core;

use PDO;

abstract class Model
{
    protected static string $table = '';
    protected static string $primaryKey = 'id';

    public static function getTable(): string
    {
        if (!empty(static::$table)) {
            return static::$table;
        }
        // Fallback: pluralize class name in snake_case (e.g. User -> users)
        $className = (new \ReflectionClass(static::class))->getShortName();
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $className)) . 's';
    }

    public static function db(): PDO
    {
        return Database::getInstance();
    }

    public static function all(string $orderBy = 'id DESC'): array
    {
        $table = static::getTable();
        $stmt = self::db()->query("SELECT * FROM `{$table}` ORDER BY {$orderBy}");
        return $stmt->fetchAll();
    }

    public static function find(int|string $id): ?array
    {
        $table = static::getTable();
        $pk = static::$primaryKey;
        $stmt = self::db()->prepare("SELECT * FROM `{$table}` WHERE `{$pk}` = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public static function findBy(string $column, mixed $value): ?array
    {
        $table = static::getTable();
        $stmt = self::db()->prepare("SELECT * FROM `{$table}` WHERE `{$column}` = :val LIMIT 1");
        $stmt->execute(['val' => $value]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public static function where(string $sqlCondition, array $params = [], string $orderBy = 'id DESC', ?int $limit = null): array
    {
        $table = static::getTable();
        if (stripos($sqlCondition, 'ORDER BY') !== false) {
            $query = "SELECT * FROM `{$table}` WHERE {$sqlCondition}";
        } else {
            $query = "SELECT * FROM `{$table}` WHERE {$sqlCondition} ORDER BY {$orderBy}";
            if ($limit !== null) {
                $query .= " LIMIT " . (int)$limit;
            }
        }
        $stmt = self::db()->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public static function firstWhere(string $sqlCondition, array $params = []): ?array
    {
        $results = static::where($sqlCondition, $params, 'id ASC', 1);
        return !empty($results) ? $results[0] : null;
    }

    public static function count(string $sqlCondition = '1=1', array $params = []): int
    {
        $table = static::getTable();
        $stmt = self::db()->prepare("SELECT COUNT(*) FROM `{$table}` WHERE {$sqlCondition}");
        $stmt->execute($params);
        return (int)$stmt->fetchColumn();
    }

    protected static array $tableColumnsCache = [];

    public static function getTableColumns(): array
    {
        $table = static::getTable();
        if (!isset(self::$tableColumnsCache[$table])) {
            try {
                $stmt = self::db()->query("DESCRIBE `{$table}`");
                self::$tableColumnsCache[$table] = $stmt->fetchAll(PDO::FETCH_COLUMN);
            } catch (\Exception $e) {
                self::$tableColumnsCache[$table] = [];
            }
        }
        return self::$tableColumnsCache[$table];
    }

    public static function create(array $data): int|string
    {
        $table = static::getTable();
        $cols = static::getTableColumns();
        
        // Auto-add timestamps only if the column actually exists in table
        if (in_array('created_at', $cols, true) && !isset($data['created_at'])) {
            $data['created_at'] = date('Y-m-d H:i:s');
        }
        if (in_array('updated_at', $cols, true) && !isset($data['updated_at'])) {
            $data['updated_at'] = date('Y-m-d H:i:s');
        }

        $fields = array_keys($data);
        $columns = implode('`, `', $fields);
        $placeholders = ':' . implode(', :', $fields);

        $sql = "INSERT INTO `{$table}` (`{$columns}`) VALUES ({$placeholders})";
        $stmt = self::db()->prepare($sql);
        $stmt->execute($data);

        return self::db()->lastInsertId();
    }

    public static function update(int|string $id, array $data): bool
    {
        $table = static::getTable();
        $pk = static::$primaryKey;
        $cols = static::getTableColumns();

        if (in_array('updated_at', $cols, true) && !isset($data['updated_at'])) {
            $data['updated_at'] = date('Y-m-d H:i:s');
        }

        $setParts = [];
        foreach (array_keys($data) as $field) {
            $setParts[] = "`{$field}` = :{$field}";
        }
        $setSql = implode(', ', $setParts);

        $data['__target_id'] = $id;
        $sql = "UPDATE `{$table}` SET {$setSql} WHERE `{$pk}` = :__target_id";
        
        $stmt = self::db()->prepare($sql);
        return $stmt->execute($data);
    }

    public static function delete(int|string $id): bool
    {
        $table = static::getTable();
        $pk = static::$primaryKey;
        $stmt = self::db()->prepare("DELETE FROM `{$table}` WHERE `{$pk}` = :id");
        return $stmt->execute(['id' => $id]);
    }

    public static function query(string $sql, array $params = []): array
    {
        $stmt = self::db()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public static function execute(string $sql, array $params = []): bool
    {
        $stmt = self::db()->prepare($sql);
        return $stmt->execute($params);
    }

    public static function paginate(int $page = 1, int $perPage = 10, string $sqlCondition = '1=1', array $params = [], string $orderBy = 'id DESC'): array
    {
        $table = static::getTable();
        $page = max(1, $page);
        $offset = ($page - 1) * $perPage;

        $totalItems = static::count($sqlCondition, $params);
        $totalPages = ceil($totalItems / $perPage) ?: 1;

        $sql = "SELECT * FROM `{$table}` WHERE {$sqlCondition} ORDER BY {$orderBy} LIMIT {$perPage} OFFSET {$offset}";
        $stmt = self::db()->prepare($sql);
        $stmt->execute($params);
        $items = $stmt->fetchAll();

        return [
            'items' => $items,
            'pagination' => [
                'page' => $page,
                'current_page' => $page,
                'perPage' => $perPage,
                'per_page' => $perPage,
                'totalItems' => $totalItems,
                'total_items' => $totalItems,
                'totalPages' => $totalPages,
                'total_pages' => $totalPages,
                'hasPrev' => $page > 1,
                'hasNext' => $page < $totalPages
            ]
        ];
    }
}
