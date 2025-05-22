<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Adicionar Cliente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../styles/php.css">
    <link rel="shortcut icon" href="../../../assets/favicon.png" type="image/x-icon">
</head>
<body>
    <h2>Adicionar Cliente</h2>
    <form method="POST" action="adicionar.php">
        Metodo: <input type="text" name="metodo" maxlength="20" placeholder="Digite o metodo" required>
        <br/><br/>
        Taxa: <input type="number" name="taxa" maxlength="10" placeholder="Digite a taxa" required>
        <br/><br/> 
        <input type="submit" value="Salvar" name="botao">
    </form>

    <?php 
    if(isset($_POST["botao"])) {
        require("conecta.php");

        // Captura e sanitiza os dados
        $metodo = trim($_POST["metodo"]);
        $taxa = trim($_POST["taxa"]);

        // Verificação básica para evitar entrada vazia
        if (empty($metodo) || empty($taxa)) {
            echo "<p style='color:red;'>Erro: Preencha todos os campos!</p>";
        } else {
            // Usando Prepared Statements para evitar SQL Injection
            $stmt = $mysqli->prepare("INSERT INTO tb_fretes (metodo, taxa) VALUES (?, ?)");
            $stmt->bind_param("ss", $metodo, $taxa);
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

    <a href='../index.php'>Voltar</a>
</body>
</html>