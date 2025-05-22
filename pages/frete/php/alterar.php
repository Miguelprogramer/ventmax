<?php 
require("conecta.php");

$metodo = "";
$taxa = "";

// Verifica se o ID foi passado na URL e é válido
if (isset($_GET["alterar"])) {
    $metodo = filter_var($_GET["alterar"], FILTER_VALIDATE_INT);

    if ($metodo === false || $metodo <= 0) {
        exit("<p style='color:red;'>Erro: ID inválido!</p>");
    }

    // Usa Prepared Statements para evitar SQL Injection
    $stmt = $mysqli->prepare("SELECT metodo, taxa FROM tb_fretes WHERE metodo = ?");
    $stmt->bind_param("s", $metodo);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $tabela = $result->fetch_assoc();
        $metodo = htmlspecialchars($tabela["metodo"]);
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
    <title>Alterar Frete</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./styles/styles.css">
</head>
<body>
    <h2>Alterar Dados do Frete</h2>
    <form method="POST" action="alterar.php">
        Metodo: <input type="text" name="metodo" value="<?php echo $metodo ?>" maxlength="20" placeholder="Digite o metodo" required>
        <br/><br/>
        Taxa: <input type="number" name="taxa" value="<?php echo $taxa ?>" maxlength="10" placeholder="Digite a taxa" required>
        <br/><br/>
        
        <input type="submit" value="Salvar" name="botao">
    </form>

    <br>
    <a href="../index.php">Voltar</a>
</body>
</html>

<?php 
if (isset($_POST["botao"])) {
    // Captura e valida os dados do formulário
    $metodo   = filter_var($_POST["metodo"]);
    $taxa  = trim($_POST["taxa"]);

    if (empty($metodo) || empty($taxa)) {
        exit("<p style='color:red;'>Erro: Preencha todos os campos corretamente.</p>");
    }

    // Usa Prepared Statements para evitar SQL Injection
    $stmt = $mysqli->prepare("UPDATE tb_fretes SET metodo = ?, taxa = ? WHERE metodo = ?");
    $stmt->bind_param("ss", $metodo, $taxa);
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