<?php

class CRUD
{
    public function read(string $table, string $column = "*", string $condition = null, $valor = null, $all = false)
    {
        if ($condition && $valor) {
            $query = "SELECT {$column} FROM {$table} WHERE {$condition} = :{$condition};";

            try {
                $stmt = Connect::getInstance()->prepare($query);
                $stmt->bindParam(":{$condition}", $valor);
                $stmt->execute();
                if ($all) {
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                return $stmt->fetch(PDO::FETCH_ASSOC);

            } catch (PDOException $exception) {
                var_dump($exception);
                return false;
            }

        } else {
            $query = "SELECT {$column} FROM {$table};";

            try {
                $stmt = Connect::getInstance()->query($query);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $exception) {
                var_dump($exception);
                return false;
            }
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