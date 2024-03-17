<?php
function get_pessoa(string $id): array
{
    $conn = mysqli_connect('127.0.0.1', 'root', '', 'db_livro');
    $result = mysqli_query($conn, "SELECT * FROM tb_pessoa WHERE id = {$id}");
    $pessoa = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $pessoa;
}

function delete_pessoa(string $id): bool
{
    $conn = mysqli_connect('127.0.0.1', 'root', '', 'db_livro');
    $result = mysqli_query($conn, "DELETE FROM tb_pessoa WHERE id = {$id}");
    mysqli_close($conn);
    return $result;
}

function insert_pessoa(array $pessoa): bool
{
    $conn = mysqli_connect('127.0.0.1', 'root', '', 'db_livro');
    $sql = "INSERT INTO tb_pessoa
            SET nome = '{$pessoa['nome']}',
                email = '{$pessoa['email']}',
                telefone = '{$pessoa['telefone']}',
                endereco = '{$pessoa['endereco']}',
                bairro = '{$pessoa['bairro']}',
                fk_id_cidade = '{$pessoa['fk_id_cidade']}'";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function update_pessoa(array $pessoa): bool
{
    $conn = mysqli_connect('127.0.0.1', 'root', '', 'db_livro');
    $sql = "UPDATE tb_pessoa
            SET nome = '{$pessoa['nome']}',
                email = '{$pessoa['email']}',
                telefone = '{$pessoa['telefone']}',
                endereco = '{$pessoa['endereco']}',
                bairro = '{$pessoa['bairro']}',
                fk_id_cidade = '{$pessoa['fk_id_cidade']}'
            WHERE id = {$pessoa['id']}";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function show_pessoas(): array
{
    $conn = mysqli_connect('127.0.0.1', 'root', '', 'db_livro');
    $sql = "SELECT
                tb_pessoa.id, tb_pessoa.nome, tb_pessoa.email, tb_pessoa.telefone,
                tb_pessoa.endereco, tb_pessoa.bairro, tb_cidade.nome AS cidade 
            FROM 
                tb_pessoa 
            JOIN 
                tb_cidade
            ON 
                tb_cidade.id = tb_pessoa.fk_id_cidade";
    $result = mysqli_query($conn, $sql);
    $lista_pessoas = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
    return $lista_pessoas;
}
