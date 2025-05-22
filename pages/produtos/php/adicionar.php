<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Adicionar Produto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../styles/styles.css" />
</head>
<body>
    <h2>Adicionar Produto</h2>
    <form method="POST" action="adicionar.php">
        Nome do Produto: <input type="text" name="produto" maxlength="20" placeholder="Digite o nome do produto" required>
        <br/><br/>
        Categoria do Produto: <input type="text" name="categoriara" maxlength="20" placeholder="Digite a categoria do produto" required>
        <br/><br/>
        Preço: <input type="text" name="preco" maxlength="50" placeholder="Digite o preço do produto" required>
        <br/><br/>
        Quantidade de Helices: <input type="number" name="helices" maxlength="20" placeholder="Digite a quantidade de helices" required>
        <br/><br/>
        
        <input type="submit" value="Salvar" name="botao">
    </form>

    <?php 
    if(isset($_POST["botao"])) {
        require("conecta.php");

        // Captura e sanitiza os dados
        $produto = trim($_POST["produto"]);
        $categoria = trim($_POST["categoria"]);
        $preco = trim($_POST["preco"]);
        $helices = trim($_POST["helices"]);

        // Verificação básica para evitar entrada vazia
        if (empty($produto) || empty($categoria) || empty($preco) || empty($helices)) {
            echo "<p style='color:red;'>Erro: Preencha todos os campos!</p>";
        } else {
            // Usando Prepared Statements para evitar SQL Injection
            $stmt = $mysqli->prepare("INSERT INTO tb_produtos (produto, categoria, preco, helices) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $produto, $categoria, $preco, $helices);
            $stmt->execute();

            if ($stmt->error) {
                echo "<p style='color:red;'>Erro ao inserir: " . $stmt->error . "</p>";
            } else {
                echo "<p style='color:green;'>Inserido com sucesso!</p>";
                echo "<a href='../index.php'>Voltar</a>";
            }

            // Fecha a consulta preparada
            $stmt->close();
        }

        // Fecha a conexão com o banco
        $mysqli->close();
    }
    ?>
</body>
</html>