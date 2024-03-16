<?php
if (!empty($_GET['id'])) {
    $conn = mysqli_connect('127.0.0.1', 'root', '', 'db_livro');
    $sql = "DELETE FROM tb_pessoa WHERE id = {$_GET['id']}";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        print 'Registro excluido com sucesso!';
    }
    mysqli_close($conn);
}
