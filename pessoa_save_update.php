<?php
$dados = $_POST;
if ($dados['id']) {
    $conn = mysqli_connect('127.0.0.1', 'root', '', 'db_livro');
    $sql = "UPDATE
            tb_pessoa
        SET
            nome = '{$dados['nome']}',
            email = '{$dados['email']}',
            telefone = '{$dados['telefone']}',
            endereco = '{$dados['endereco']}',
            bairro = '{$dados['bairro']}',
            fk_id_cidade = '{$dados['cidade']}'
        WHERE id = {$dados['id']}";
    if ($result = mysqli_query($conn, $sql)) {
        print 'Registro atualizado com sucesso!';
    }
    mysqli_close($conn);
}
