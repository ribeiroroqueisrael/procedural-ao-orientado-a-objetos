<?php
require_once 'db/pessoa_db.php';

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

    if ($_GET['action'] === 'edit') {

        if (!empty($_GET['id'])) {
            $id = (int) $_GET['id'];
            $pessoa = get_pessoa($id);
        }
    } else if ($_GET['action'] === 'save') {
        $pessoa = $_POST;
        if (empty($pessoa['id'])) {
            $result = insert_pessoa($pessoa);
        } else {
            $result = update_pessoa($pessoa);
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
