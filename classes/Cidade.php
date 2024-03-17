<?php

class Cidade
{
    public static function listAll(): array
    {
        $conn = new PDO('mysql:host=127.0.0.1;port=3306;dbname=db_livro;charset=utf8mb4', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $conn->query("SELECT id, nome FROM tb_cidade ORDER BY nome");
        return $result->fetchAll();
    }
}
