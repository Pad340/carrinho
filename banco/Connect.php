<?php

namespace banco;
use PDO;
use PDOException;

class Connect extends PDO
{
    public static function getInstance()
    {
        try {
            $user = 'root';
            $password = '';
            $database = 'carrinho';
            $url = 'localhost:3304';
            $connect = new PDO('mysql:host=' . $url . ';dbname=' . $database, $user, $password);
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $connect;
        } catch (PDOException $erro) {
            echo 'Ocorreu o seguinte erro: ' . $erro->getMessage();
            return null;
        }
    }
}