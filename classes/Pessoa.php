<?php

class Pessoa
{
    public static function findById(string $id): array
    {
        $conn = new PDO('mysql:host=127.0.0.1;port=3306;dbname=db_livro;charset=utf8mb4', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $conn->query("SELECT * FROM tb_pessoa WHERE id = {$id}");
        return $result->fetch();
    }

    public static function delete(string $id): PDOStatement
    {
        $conn = new PDO('mysql:host=127.0.0.1;port=3306;dbname=db_livro;charset=utf8mb4', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $conn->query("DELETE FROM tb_pessoa WHERE id = {$id}");
        return $result;
    }

    public static function save(array $pessoa): PDOStatement
    {
        $conn = new PDO('mysql:host=127.0.0.1;port=3306;dbname=db_livro;charset=utf8mb4', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (empty($pessoa['id'])) {
            $sql = "INSERT INTO tb_pessoa
                    SET nome = '{$pessoa['nome']}',
                        email = '{$pessoa['email']}',
                        telefone = '{$pessoa['telefone']}',
                        endereco = '{$pessoa['endereco']}',
                        bairro = '{$pessoa['bairro']}',
                        fk_id_cidade = '{$pessoa['fk_id_cidade']}'";
            return $conn->query($sql);
        } else {
            $sql = "UPDATE tb_pessoa
                    SET nome = '{$pessoa['nome']}',
                        email = '{$pessoa['email']}',
                        telefone = '{$pessoa['telefone']}',
                        endereco = '{$pessoa['endereco']}',
                        bairro = '{$pessoa['bairro']}',
                        fk_id_cidade = '{$pessoa['fk_id_cidade']}'
                    WHERE id = {$pessoa['id']}";
            return $conn->query($sql);
        }
    }

    public static function listAll(): array
    {
        $conn = new PDO('mysql:host=127.0.0.1;port=3306;dbname=db_livro;charset=utf8mb4', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT
                    tb_pessoa.id, tb_pessoa.nome, tb_pessoa.email, tb_pessoa.telefone,
                    tb_pessoa.endereco, tb_pessoa.bairro, tb_cidade.nome AS cidade 
                FROM 
                    tb_pessoa 
                JOIN 
                    tb_cidade
                ON 
                    tb_cidade.id = tb_pessoa.fk_id_cidade";
        $result = $conn->query($sql);
        return $result->fetchAll();
    }
}
