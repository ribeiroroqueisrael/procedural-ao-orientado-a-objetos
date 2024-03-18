<?php

class Pessoa
{
    private static $conn;

    public static function getConnection()
    {
        if (empty(self::$conn)) {
            $database = parse_ini_file('config/database.ini');
            $driver = $database['DRIVER'];
            $host = $database['HOST'];
            $port = $database['PORT'];
            $db = $database['DBNAME'];
            $charset = $database['CHARSET'];
            $user = $database['USER'];
            $pass = $database['PASS'];

            self::$conn = new PDO(
                "{$driver}:host={$host};port={$port};dbname={$db};charset={$charset}",
                "{$user}",
                "{$pass}"
            );
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$conn;
    }

    public static function findById(string $id): array
    {
        $conn = self::getConnection();
        $result = $conn->prepare("SELECT * FROM tb_pessoa WHERE id = :id");
        $result->execute(['id' => $id]);
        return $result->fetch();
    }

    public static function delete($id)
    {
        $conn = self::getConnection();
        $result = $conn->prepare("DELETE FROM tb_pessoa WHERE id = :id");
        $result->execute(['id' => $id]);
        return $result;
    }

    public static function save(array $pessoa): PDOStatement
    {
        $conn = self::getConnection();
        if (empty($pessoa['id'])) {
            $sql = "INSERT INTO tb_pessoa
                    SET nome = :nome,
                        email = :email,
                        telefone = :telefone,
                        endereco = :endereco,
                        bairro = :bairro,
                        fk_id_cidade = :fk_id_cidade";

            $result = $conn->prepare($sql);
            $result->execute([
                'nome' => $pessoa['nome'],
                'email' => $pessoa['email'],
                'telefone' => $pessoa['telefone'],
                'endereco' => $pessoa['endereco'],
                'bairro' => $pessoa['bairro'],
                'fk_id_cidade' => $pessoa['fk_id_cidade'],
            ]);
            return $result;
        } else {
            $sql = "UPDATE tb_pessoa
                    SET nome = :nome,
                        email = :email,
                        telefone = :telefone,
                        endereco = :endereco,
                        bairro = :bairro,
                        fk_id_cidade = :fk_id_cidade
                    WHERE id = :id";

            $result = $conn->prepare($sql);
            $result->execute([
                'id' => $pessoa['id'],
                'nome' => $pessoa['nome'],
                'email' => $pessoa['email'],
                'telefone' => $pessoa['telefone'],
                'endereco' => $pessoa['endereco'],
                'bairro' => $pessoa['bairro'],
                'fk_id_cidade' => $pessoa['fk_id_cidade'],
            ]);
            return $result;
        }
    }

    public static function listAll(): array
    {
        $conn = self::getConnection();
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
