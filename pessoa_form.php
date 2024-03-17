<?php
$pessoa = [
    'id' => '',
    'nome' => '',
    'email' => '',
    'telefone' => '',
    'endereco' => '',
    'bairro' => '',
    'fk_id_cidade' => '',
];
if (!empty($_GET['action'])) {
    $conn = mysqli_connect('127.0.0.1', 'root', '', 'db_livro');

    if ($_GET['action'] === 'edit') {

        if (!empty($_GET['id'])) {
            $id = (int) $_GET['id'];
            $sql = "SELECT * FROM tb_pessoa WHERE id = {$id}";
            $result = mysqli_query($conn, $sql);
            $pessoa = mysqli_fetch_assoc($result);
        }
        mysqli_close($conn);
    } else if ($_GET['action'] === 'save') {
        $pessoa = $_POST;
        if (empty($pessoa['id'])) {
            $sql = "INSERT INTO tb_pessoa SET nome = '{$pessoa['nome']}',
                                  email = '{$pessoa['email']}',
                                  telefone = '{$pessoa['telefone']}',
                                  endereco = '{$pessoa['endereco']}',
                                  bairro = '{$pessoa['bairro']}',
                                  fk_id_cidade = '{$pessoa['fk_id_cidade']}'";
            $result = mysqli_query($conn, $sql);
        } else {
            $sql = "UPDATE tb_pessoa
                    SET nome = '{$pessoa['nome']}',
                        email = '{$pessoa['email']}',
                        telefone = '{$pessoa['telefone']}',
                        endereco = '{$pessoa['endereco']}',
                        bairro = '{$pessoa['bairro']}',
                        fk_id_cidade = '{$pessoa['fk_id_cidade']}'
                    WHERE id = {$pessoa['id']}";
            $result = mysqli_query($conn, $sql);
        }
        print $result ? 'Registro salvo com sucesso!' : '';
    }
}

require_once 'lista_cidades.php';
$cidades = lista_cidades($pessoa['fk_id_cidade']);

$form = file_get_contents('html/form.html');
$form = str_replace('{id}', $pessoa['id'], $form);
$form = str_replace('{nome}', $pessoa['nome'], $form);
$form = str_replace('{email}', $pessoa['email'], $form);
$form = str_replace('{telefone}', $pessoa['telefone'], $form);
$form = str_replace('{endereco}', $pessoa['endereco'], $form);
$form = str_replace('{bairro}', $pessoa['bairro'], $form);
$form = str_replace('{cidades}', $cidades, $form);

print $form;
