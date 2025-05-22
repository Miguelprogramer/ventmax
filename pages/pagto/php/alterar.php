<?php 
require("conecta.php");

$forma = "";
$taxa = "";

// Verifica se o ID foi passado na URL e é válido
if (isset($_GET["alterar"])) {
    if ($forma === false || $iforma <= 0) {
        exit("<p style='color:red;'>Erro: ID inválido!</p>");
    }

    // Usa Prepared Statements para evitar SQL Injection
    $stmt = $mysqli->prepare("SELECT forma, taxa FROM tb_fpagto WHERE forma = ?");
    $stmt->bind_param("s", $forma);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $tabela = $result->fetch_assoc();
        $forma = htmlspecialchars($tabela["forma"]);
        $taxa = htmlspecialchars($tabela["taxa"]);

    } else {
        exit("<p style='color:red;'>Erro: Cliente não encontrado!</p>");
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
    <link rel="stylesheet" href="../styles/styles.css" />
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

    if (empty($forma) || empty($taxa)) {
        exit("<p style='color:red;'>Erro: Preencha todos os campos corretamente.</p>");
    }

    // Usa Prepared Statements para evitar SQL Injection
    $stmt = $mysqli->prepare("UPDATE tb_fpagto SET forma = ?, taxa = ? WHERE forma = ?");
    $stmt->bind_param("ss", $forma, $taxa);
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