<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pesquisar Produto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../styles/php.css" />
    <link rel="shortcut icon" href="../../../assets/favicon.png" type="image/x-icon">
</head>
<body>
    <h2>Pesquisar Produto</h2>
    <form method="POST" action="pesquisar.php">
        Nome do Produto: <input type="text" name="produto" maxlength="40" placeholder="Digite o nome do produto">
        <input type="submit" value="Pesquisar" name="botao">
    </form>

    <?php 
    if(isset($_POST["botao"])) {
        require("conecta.php");

        // Sanitiza a entrada
        $produto = trim($_POST["produto"]);

        if (empty($produto)) {
            echo "<p style='color:red;'>Erro: Informe um nome do produto para pesquisar.</p>";
        } else {
            // Utilizando Prepared Statements
            $stmt = $mysqli->prepare("SELECT * FROM tb_produtos WHERE produto LIKE ?");
            $pesquisa = "%$produto%";  
            $stmt->bind_param("s", $pesquisa);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "
                <table border='1' width='400'>
                    <tr>
                        <th>Produto</th>
                        <th>Categoria</th>
                        <th>Preço</th>
                        <th>Helices</th>
                    </tr>
                ";
                while ($tabela = $result->fetch_assoc()) {
                    echo "
                    <tr>
                    <td align='center'>{$tabela['produto']}</td>
                    <td align='center'>{$tabela['categoria']}</td>
                    <td align='center'>{$tabela['preco']}</td>
                    <td align='center'>{$tabela['helices']}</td>
                    </tr>";
                }
                echo "</table>";
            } else {
                echo "<p style='color:blue;'>Nenhum produto encontrado.</p>";
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