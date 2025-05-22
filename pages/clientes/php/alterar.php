<?php 
require("conecta.php");

$cpfcli = "";
$nomecli = "";
$cidadecli = "";
$bairrocli = "";
$ruacli = "";
$residcli = "";
$telcli = "";
$emailcli = "";

// Verifica se o ID foi passado na URL e é válido
if (isset($_GET["alterar"])) {
    $idcli = filter_var($_GET["alterar"], FILTER_VALIDATE_INT);

    if ($idcli === false || $idcli <= 0) {
        exit("<p style='color:red;'>Erro: ID inválido!</p>");
    }

    // Usa Prepared Statements para evitar SQL Injection
    $stmt = $mysqli->prepare("SELECT cpfcli, nomecli, cidadecli, bairrocli, ruacli, residcli, telcli, emailcli FROM tb_clientes WHERE cpfcli = ?");
    $stmt->bind_param("i", $idcli);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $tabela = $result->fetch_assoc();
        $cpfcli = htmlspecialchars($tabela["cpfcli"]);
        $nomecli = htmlspecialchars($tabela["nomecli"]);
        $cidadecli = htmlspecialchars($tabela["cidadecli"]);
        $bairrocli = htmlspecialchars($tabela["bairrocli"]);
        $ruacli = htmlspecialchars($tabela["ruacli"]);
        $residcli = htmlspecialchars($tabela["residcli"]);
        $telcli = htmlspecialchars($tabela["telcli"]);
        $emailcli = htmlspecialchars($tabela["emailcli"]);

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
    <title>Alterar Cliente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../styles/styles.css" />
</head>
<body>
    <h2>Alterar Dados do Cliente</h2>
    <form method="POST" action="alterar.php">
        Nome Completo: <input type="text" name="nomecli" maxlength="50" placeholder="Digite o nome completo" required>
        <br/><br/>
        CPF: <input type="text" name="cpfcli" maxlength="20" placeholder="Digite o cpf" required>
        <br/><br/>
        Cidade: <input type="text" name="cidadecli" maxlength="40" placeholder="Digite a cidade" required>
        <br/><br/>
        Bairro: <input type="text" name="bairrocli" maxlength="40" placeholder="Digite o bairro" required>
        <br/><br/>
        Rua: <input type="text" name="ruacli" maxlength="50" placeholder="Digite a rua" required>
        <br/><br/>
        N° da Residência: <input type="number" name="residcli" maxlength="11" placeholder="Digite a cidade" required>
        <br/><br/>
        Telefone: <input type="tel" name="telcli" maxlength="20" placeholder="Digite o telefone" required>
        <br/><br/>
        Email: <input type="email" name="emailcli" maxlength="40" placeholder="Digite o email" required>
        <br/><br/>
        
        <input type="submit" value="Salvar" name="botao">
    </form>

    <br>
    <a href="../index.php">Voltar</a>
</body>
</html>

<?php 
if (isset($_POST["botao"])) {
    $cpfcli = trim($_POST["cpfcli"]);
    $nomecli = trim($_POST["nomecli"]);
    $cidadecli = trim($_POST["cidadecli"]);
    $bairrocli = trim($_POST["bairrocli"]);
    $ruacli = trim($_POST["ruacli"]);
    $residcli = trim($_POST["residcli"]);
    $telcli = trim($_POST["telcli"]);
    $emailcli = trim($_POST["emailcli"]);

    if (empty($cpfcli) || empty($nomecli) || empty($cidadecli) || empty($bairrocli) || empty($ruacli) || empty($residcli) || empty($telcli) || empty($emailcli)) {
        echo "<p style='color:red;'>Erro: Preencha todos os campos!</p>";
    }

    // Usa Prepared Statements para evitar SQL Injection
    $stmt = $mysqli->prepare("UPDATE tb_clientes SET cpfcli = ?, nomecli = ?, cidadecli = ?, bairrocli = ?, ruacli = ?, residcli = ?, telcli = ?, emailcli = ? WHERE cpfcli = ?");
    $stmt->bind_param("ssssssss", $cpfcli, $nomecli, $cidadecli, $bairrocli, $ruacli, $residcli, $telcli, $emailcli);
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