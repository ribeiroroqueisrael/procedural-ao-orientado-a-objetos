<?php
$id = '';
$nome = '';
$email = '';
$telefone = '';
$endereco = '';
$bairro = '';
$id_cidade = '';

if (!empty($_GET['action'])) {
    $conn = mysqli_connect('127.0.0.1', 'root', '', 'db_livro');
    if ($_GET['action'] === 'edit') {
        if (!empty($_GET['id'])) {
            $id = (int) $_GET['id'];
            $sql = "SELECT * FROM tb_pessoa WHERE id = {$id}";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $nome = $row['nome'];
                $email = $row['email'];
                $telefone = $row['telefone'];
                $endereco = $row['endereco'];
                $bairro = $row['bairro'];
                $id_cidade = $row['fk_id_cidade'];
            }
        }
        mysqli_close($conn);
        $title = 'Editar Dados Pessoas';
        $botao = 'Atualizar';
    } else if ($_GET['action'] === 'save') {
        $dados = $_POST;
        if (empty($dados['id'])) {
            $sql = "INSERT INTO tb_pessoa SET nome = '{$dados['nome']}',
                                  email = '{$dados['email']}',
                                  telefone = '{$dados['telefone']}',
                                  endereco = '{$dados['endereco']}',
                                  bairro = '{$dados['bairro']}',
                                  fk_id_cidade = '{$dados['cidade']}'";
            $result = mysqli_query($conn, $sql);
        } else {
            $sql = "UPDATE tb_pessoa
                    SET nome = '{$dados['nome']}',
                        email = '{$dados['email']}',
                        telefone = '{$dados['telefone']}',
                        endereco = '{$dados['endereco']}',
                        bairro = '{$dados['bairro']}',
                        fk_id_cidade = '{$dados['cidade']}'
                    WHERE id = {$dados['id']}";
            $result = mysqli_query($conn, $sql);
        }
        print $result ? 'Registro salvo com sucesso!' : '';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Cadastramento de Pessoas' ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <form class="container c-form" action="pessoa_form.php?action=save" method="post" enctype="multipart/form-data">
        <!-- INPUT ID -->
        <div class="mb-3 c-form__group">
            <label class="form-label">Código</label>
            <input class="form-control bg-light w-25" type="text" name="id" readonly value="<?= $id ?>">
        </div>
        <!-- INPUT NOME -->
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input class="form-control" type="text" name="nome" value="<?= $nome ?>">
        </div>
        <!-- INPUT E-MAIL -->
        <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input class="form-control" type="text" name="email" value="<?= $email ?>">
        </div>
        <!-- INPUT TELEFONE -->
        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input class="form-control" type="text" name="telefone" value="<?= $telefone ?>">
        </div>
        <!-- INPUT ENDERECO -->
        <div class="mb-3">
            <label class="form-label">Endereço</label>
            <input class="form-control" type="text" name="endereco" value="<?= $endereco ?>">
        </div>
        <!-- INPUT BAIRRO -->
        <div class="mb-3">
            <label class="form-label">Bairro</label>
            <input class="form-control" type="text" name="bairro" value="<?= $bairro ?>">
        </div>
        <!-- SELECT CIDADE -->
        <div class="mb-3">
            <label class="form-label">Cidade</label>
            <select class="form-control" name="cidade">
                <?php
                $conn = mysqli_connect('127.0.0.1', 'root', '', 'db_livro');
                $result = mysqli_query($conn, "SELECT id, nome FROM tb_cidade ORDER BY nome");
                while ($row = mysqli_fetch_assoc($result)) {
                    $selected = $row['id'] === $id_cidade ? 'selected' : '';
                    print "<option value='{$row['id']}' {$selected}>{$row['nome']}</option>";
                }
                ?>
            </select>
        </div>
        <!-- INPUT  -->
        <div class="mb-3">
            <input class="btn btn-secondary" type="submit" value="<?= $botao ?? 'Cadastrar' ?>">
        </div>
    </form>
</body>

</html>