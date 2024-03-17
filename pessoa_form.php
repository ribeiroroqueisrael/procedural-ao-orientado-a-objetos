<?php
require_once 'classes/Pessoa.php';
require_once 'classes/Cidade.php';

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

    try {
        if ($_GET['action'] === 'edit') {

            if (!empty($_GET['id'])) {
                $id = (int) $_GET['id'];
                $pessoa = Pessoa::findById($id);
            }
        } else if ($_GET['action'] === 'save') {
            Pessoa::save($_POST);
            print 'Registro salvo com sucesso!';
        }
    } catch (Exception $e) {
        print $e->getMessage();
    }
}

$cidades = '';
foreach (Cidade::listAll() as $cidade) {
    $selected = $cidade['id'] === $pessoa['fk_id_cidade'] ? 'selected' : '';
    $cidades .= "<option value='{$cidade['id']}' {$selected}>{$cidade['nome']}</option>";
}

$form = file_get_contents('html/form.html');
$form = str_replace('{id}', $pessoa['id'], $form);
$form = str_replace('{nome}', $pessoa['nome'], $form);
$form = str_replace('{email}', $pessoa['email'], $form);
$form = str_replace('{telefone}', $pessoa['telefone'], $form);
$form = str_replace('{endereco}', $pessoa['endereco'], $form);
$form = str_replace('{bairro}', $pessoa['bairro'], $form);
$form = str_replace('{cidades}', $cidades, $form);

print $form;
