<?php

namespace banco;

use PDO;
use PDOException;

class CRUD
{
    public function read(string $table, string $column = "*", string $condition = null, $all = false)
    {

        $query = "SELECT {$column} FROM {$table} {$condition}";

        try {
            $stmt = Connect::getInstance()->prepare($query);
            $stmt->execute();
            if ($all) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $exception) {
            var_dump($exception);
            return false;
        }

    }

    public function fullRead(string $query)
    {
        try {
            $stmt = Connect::getInstance()->prepare($query);

            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            return false;

        } catch (PDOException $exception) {
            var_dump($exception);
            return false;
        }
    }

    public function insert(string $table, string $values, string $columns = null)
    {
        if (isset($columns)) {
            $query = "INSERT INTO {$table} ({$columns}) VALUES ({$values});";
        } else {
            $query = "INSERT INTO {$table} VALUES ({$values});";
        }
        try {
            $stmt = Connect::getInstance();

            if ($stmt->exec($query)) {
                return $stmt->lastInsertId();
            }
            return false;

        } catch (PDOException $exception) {
            var_dump($exception);
            return false;
        }
    }
}