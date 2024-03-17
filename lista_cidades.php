<?php
function lista_cidades(string $id_cidade = null): string
{
    $conn = mysqli_connect('127.0.0.1', 'root', '', 'db_livro');
    $result = mysqli_query($conn, "SELECT id, nome FROM tb_cidade ORDER BY nome");
    $output = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $selected = $row['id'] === $id_cidade ? 'selected' : '';
        $output .= "<option value='{$row['id']}' {$selected}>{$row['nome']}</option>";
    }

    return $output;
}
