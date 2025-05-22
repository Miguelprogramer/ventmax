<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Adicionar Forma de Pagamento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../styles/php.css" />
</head>
<body>
    <h2>Adicionar Forma de Pagamento</h2>
    <form method="POST" action="adicionar.php">
        Forma de Pagamento: <input type="text" name="forma" maxlength="20" placeholder="Digite a forma de pagamento" required>
        <br/><br/>
        Taxa: <input type="text" name="taxa" maxlength="10" placeholder="Digite a taxa" required>
        <br/><br/>
        
        <input type="submit" value="Salvar" name="botao">
    </form>

    <?php 
    require("conecta.php");

if ($mysqli->connect_error) {
    die("Erro de conexão: " . $mysqli->connect_error);
}

$forma = trim($_POST["forma"]);
$taxa = trim($_POST["taxa"]);

if (empty($forma) || empty($taxa)) {
    echo "<p style='color:red;'>Erro: Preencha todos os campos!</p>";
} else {
    // Verifique se a taxa é um número real
    $taxa = str_replace(',', '.', $taxa); // opcional, se o usuário digitar com vírgula
    if (!is_numeric($taxa)) {
        echo "<p style='color:red;'>Erro: Taxa inválida!</p>";
    } else {
        $taxa = floatval($taxa); // converte para número real

        $stmt = $mysqli->prepare("INSERT INTO tb_pagto (forma, taxa) VALUES (?, ?)");

        if (!$stmt) {
            die("Erro ao preparar a query: " . $mysqli->error);
        }

        $stmt->bind_param("sd", $forma, $taxa); // 's' string, 'd' double (real)
        $stmt->execute();

        if ($stmt->error) {
            echo "<p style='color:red;'>Erro ao inserir: " . $stmt->error . "</p>";
        } else {
            echo "<p style='color:green;'>Inserido com sucesso!</p>";
            echo "<a href='../index.php'>Voltar</a>";
        }

        $stmt->close();
    }
}

$mysqli->close();
    ?>

     <a href='../index.php'>Voltar</a>
</body>
</html>