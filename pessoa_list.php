<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Pessoas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <table class="table table-stripped table-bordered text-center">
        <thead>
            <tr>
                <th class="table-danger text-danger">Excluir</th>
                <th class="table-warning text-warning">Editar</th>
                <th>Código</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>Bairro</th>
                <th>Cidade</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $conn = mysqli_connect('127.0.0.1', 'root', '', 'db_livro');
            if (!empty($_GET['action']) and ($_GET['action'] === 'delete')) {
                $id = (int) $_GET['id'];
                $sql = "DELETE FROM tb_pessoa WHERE id = {$id}";
                mysqli_query($conn, $sql);
            }
            $sql = "SELECT
                        tb_pessoa.id,
                        tb_pessoa.nome,
                        tb_pessoa.email,
                        tb_pessoa.telefone,
                        tb_pessoa.endereco,
                        tb_pessoa.bairro,
                        tb_cidade.nome AS cidade 
                    FROM
                        tb_pessoa
                    JOIN
                        tb_cidade
                    ON
                        tb_cidade.id = tb_pessoa.fk_id_cidade";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $nome = $row['nome'];
                $email = $row['email'];
                $telefone = $row['telefone'];
                $endereco = $row['endereco'];
                $bairro = $row['bairro'];
                $cidade = $row['cidade'];
                print '<tr>';
                print "<td class='table-danger'><a href='pessoa_list.php?action=delete&id={$id}'><img src='images/del.svg'></a></td>";
                print "<td class='table-warning'><a href='pessoa_form.php?action=edit&id={$id}'><img src='images/edit.svg'></a></td>";
                print "<td>{$id}</td>";
                print "<td>{$nome}</td>";
                print "<td>{$email}</td>";
                print "<td>{$telefone}</td>";
                print "<td>{$endereco}</td>";
                print "<td>{$bairro}</td>";
                print "<td>{$cidade}</td>";
                print '</tr>';
            }
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
    <button class="btn btn-light" onclick="window.location.href='pessoa_form.php'">
        <img class="me-2" src="images/add.svg">
        Inserir
    </button>
</body>

</html>