<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pesquisar Cliente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../styles/php.css" />
</head>
<body>
    <h2>Pesquisar Cliente</h2>
    <form method="POST" action="pesquisar.php">
        Nome do Cliente: <input type="text" name="nomecli" maxlength="50" placeholder="Digite o nome">
        <input type="submit" value="Pesquisar" name="botao">
    </form>

    <?php 
    if(isset($_POST["botao"])) {
        require("conecta.php");

        // Sanitiza a entrada
        $nomecli = trim($_POST["nomecli"]);

        if (empty($nomecli)) {
            echo "<p style='color:red;'>Erro: Informe um nome para pesquisar.</p>";
        } else {
            // Utilizando Prepared Statements
            $stmt = $mysqli->prepare("SELECT * FROM tb_clientes WHERE nomecli LIKE ?");
            $pesquisa = "%$nomecli%";  
            $stmt->bind_param("s", $pesquisa);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "
                <table border='1' width='400'>
                    <tr>
                        <th>Nome Completo</th>
                        <th>CPF</th>
                        <th>Cidade</th>
                        <th>Bairro</th>
                        <th>Rua</th>
                        <th>N° de Residência</th>
                        <th>Telefone</th>
                        <th>Email</th>
                    </tr>
                ";
                while ($tabela = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td align='center'>{$tabela['nomecli']}</td>
                        <td align='center'>{$tabela['cpfcli']}</td>
                        <td align='center'>{$tabela['cidadecli']}</td>
                        <td align='center'>{$tabela['bairrocli']}</td>
                        <td align='center'>{$tabela['ruacli']}</td>
                        <td align='center'>{$tabela['residcli']}</td>
                        <td align='center'>{$tabela['telcli']}</td>
                        <td align='center'>{$tabela['emailcli']}</td> 
                    </tr>";
                }
                echo "</table>";
            } else {
                echo "<p style='color:blue;'>Nenhum cliente encontrado.</p>";
            }

            // Fechando recursos
            $stmt->close();
            $mysqli->close();
        }
    }
    ?>
    <br>
    <a href='../index.php'>Voltar</a>
</body>
</html>