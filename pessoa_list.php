<?php
$conn = mysqli_connect('127.0.0.1', 'root', '', 'db_livro');

if (!empty($_GET['action']) and ($_GET['action'] === 'delete')) {
    $id = (int) $_GET['id'];
    $sql = "DELETE FROM tb_pessoa WHERE id = {$id}";
    mysqli_query($conn, $sql);
}
$sql = "SELECT tb_pessoa.id, tb_pessoa.nome, tb_pessoa.email, tb_pessoa.telefone,
               tb_pessoa.endereco, tb_pessoa.bairro, tb_cidade.nome AS cidade 
        FROM tb_pessoa JOIN tb_cidade ON tb_cidade.id = tb_pessoa.fk_id_cidade";
$result = mysqli_query($conn, $sql);
$items = '';
while ($row = mysqli_fetch_assoc($result)) {
    $item = file_get_contents('html/item.html');
    $item  = str_replace('{id}', $row['id'], $item);
    $item  = str_replace('{nome}', $row['nome'], $item);
    $item  = str_replace('{email}', $row['email'], $item);
    $item  = str_replace('{telefone}', $row['telefone'], $item);
    $item  = str_replace('{endereco}', $row['endereco'], $item);
    $item  = str_replace('{bairro}', $row['bairro'], $item);
    $item  = str_replace('{cidade}', $row['cidade'], $item);

    $items .= $item;
}
mysqli_close($conn);

$list = file_get_contents('html/list.html');
$list = str_replace('{items}', $items, $list);
print $list;
