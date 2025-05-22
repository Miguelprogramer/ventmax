<?php 
require("conecta.php");

$forma = "";
$taxa = "";
$formaAntiga = "";

// Verifica se o parâmetro foi passado na URL
if (isset($_GET["alterar"])) {
    $formaAntiga = $_GET["alterar"];
    // Usa Prepared Statements para evitar SQL Injection
    $stmt = $mysqli->prepare("SELECT forma, taxa FROM tb_pagto WHERE forma = ?");
    $stmt->bind_param("s", $formaAntiga);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $tabela = $result->fetch_assoc();
        $forma = htmlspecialchars($tabela["forma"]);
        $taxa = htmlspecialchars($tabela["taxa"]);
    } else {
        exit("<p style='color:red;'>Erro: Forma de pagamento não encontrada!</p>");
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Alterar Forma de Pagamento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../styles/php.css" />
    <link rel="shortcut icon" href="../../../assets/favicon.png" type="image/x-icon">
</head>
<body>
    <h2>Alterar Forma de Pagamento</h2>
    <form method="POST" action="alterar.php">
        Forma de Pagamento: <input type="text" name="forma" value="<?php echo $forma ?>" maxlength="20" placeholder="Digite a forma de pagamento" required>
        <br/><br/>
        Taxa: <input type="text" name="taxa" value="<?php echo $taxa ?>" maxlength="10" placeholder="Digite a taxa" required>
        
        <input type="submit" value="Salvar" name="botao">
    </form>

    <br>
    <a href="../index.php">Voltar</a>
</body>
</html>

<?php 
if (isset($_POST["botao"])) {
    // Captura e valida os dados do formulário
    $forma  = trim($_POST["forma"]);
    $taxa = trim($_POST["taxa"]);
    $formaAntiga = isset($_GET["alterar"]) ? $_GET["alterar"] : $forma;

    if (empty($forma) || empty($taxa)) {
        exit("<p style='color:red;'>Erro: Preencha todos os campos corretamente.</p>");
    }

    // Usa Prepared Statements para evitar SQL Injection
    $stmt = $mysqli->prepare("UPDATE tb_pagto SET forma = ?, taxa = ? WHERE forma = ?");
    $stmt->bind_param("sss", $forma, $taxa, $formaAntiga);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<p style='color:green;'>Alterado com sucesso!</p>";
    } else {
        echo "<p style='color:blue;'>Nenhuma alteração realizada.</p>";
    }

    $stmt->close();
    $mysqli->close();
}
?>