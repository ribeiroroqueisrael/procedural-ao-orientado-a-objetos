<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastramento de Pessoas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <form class="container c-form" action="pessoa_save_insert.php" method="post" enctype="multipart/form-data">
        <!-- INPUT ID -->
        <div class="mb-3 c-form__group">
            <label class="form-label">Código</label>
            <input class="form-control bg-light w-25" type="text" name="id" readonly>
        </div>
        <!-- INPUT NOME -->
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input class="form-control" type="text" name="nome">
        </div>
        <!-- INPUT E-MAIL -->
        <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input class="form-control" type="text" name="email">
        </div>
        <!-- INPUT TELEFONE -->
        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input class="form-control" type="text" name="telefone">
        </div>
        <!-- INPUT ENDERECO -->
        <div class="mb-3">
            <label class="form-label">Endereço</label>
            <input class="form-control" type="text" name="endereco">
        </div>
        <!-- INPUT BAIRRO -->
        <div class="mb-3">
            <label class="form-label">Bairro</label>
            <input class="form-control" type="text" name="bairro">
        </div>
        <!-- SELECT CIDADE -->
        <div class="mb-3">
            <label class="form-label">Cidade</label>
            <select class="form-control" name="cidade">
                <?php
                $conn = mysqli_connect('127.0.0.1', 'root', '', 'db_livro');
                $result = mysqli_query($conn, "SELECT id, nome FROM tb_cidade ORDER BY nome");
                while ($row = mysqli_fetch_assoc($result)) {
                    print "<option value='{$row['id']}'>{$row['nome']}</option>";
                }
                mysqli_close($conn);
                ?>
            </select>
        </div>
        <!-- INPUT  -->
        <div class="mb-3">
            <input class="btn btn-secondary" type="submit" value="Cadastrar">
        </div>
    </form>
</body>

</html>