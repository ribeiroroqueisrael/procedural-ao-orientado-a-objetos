<?php
$dados = $_POST;
$conn = mysqli_connect('127.0.0.1', 'root', '', 'db_livro');
$sql = "INSERT INTO tb_pessoa SET nome = '{$dados['nome']}',
                                  email = '{$dados['email']}',
                                  telefone = '{$dados['telefone']}',
                                  endereco = '{$dados['endereco']}',
                                  bairro = '{$dados['bairro']}',
                                  fk_id_cidade = '{$dados['cidade']}'";
if ($result = mysqli_query($conn, $sql)) {
    print 'Registro inserido com sucesso!';
}
mysqli_close($conn);
