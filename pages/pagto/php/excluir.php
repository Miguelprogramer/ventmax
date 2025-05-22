<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Excluir Forma de Pagamento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../styles/php.css" />
    <link rel="shortcut icon" href="../../../assets/favicon.png" type="image/x-icon">
</head>
<body> 
    <?php
if (isset($_GET['excluir'])) {
    require('conecta.php');
    $forma = $_GET['excluir'];

    if (empty($forma)) {
        echo "<p style='color:red;'>Erro: Forma de pagamento inválida!</p>";
    } else {
        $stmt = $mysqli->prepare("DELETE FROM tb_pagto WHERE forma = ?");
        $stmt->bind_param("s", $forma);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<p style='color:green;'>Excluído com sucesso!</p>";
        } else {
            echo "<p style='color:blue;'>Nenhuma forma de pagamento encontrada.</p>";
        }
        $stmt->close();
        $mysqli->close();
    }
} else {
    echo "<p style='color:red;'>Erro: Nenhuma Forma de Pagamento informada.</p>";
}
?>


    <br>
    <a href='../index.php'>Voltar</a>
</body>
</html>