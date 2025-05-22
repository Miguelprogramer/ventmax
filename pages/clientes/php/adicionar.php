<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Adicionar Cliente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../styles/php.css" />
    <link rel="shortcut icon" href="../../../assets/favicon.png" type="image/x-icon">
</head>
<body>
    <h2>Adicionar Dados do Cliente</h2>
    <form method="POST" action="adicionar.php">
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

    <?php 
    if(isset($_POST["botao"])) {
        require("conecta.php");

        // Captura e sanitiza os dados
        $cpfcli = trim($_POST["cpfcli"]);
        $nomecli = trim($_POST["nomecli"]);
        $cidadecli = trim($_POST["cidadecli"]);
        $bairrocli = trim($_POST["bairrocli"]);
        $ruacli = trim($_POST["ruacli"]);
        $residcli = trim($_POST["residcli"]);
        $telcli = trim($_POST["telcli"]);
        $emailcli = trim($_POST["emailcli"]);

        // Verificação básica para evitar entrada vazia
        if (empty($cpfcli) || empty($nomecli) || empty($cidadecli) || empty($bairrocli) || empty($ruacli) || empty($residcli) || empty($telcli) || empty($emailcli)) {
            echo "<p style='color:red;'>Erro: Preencha todos os campos!</p>";
        } else {
            // Usando Prepared Statements para evitar SQL Injection
            $stmt = $mysqli->prepare("INSERT INTO tb_clientes (cpfcli, nomecli, cidadecli, bairrocli, ruacli, residcli, telcli, emailcli) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $cpfcli, $nomecli, $cidadecli, $bairrocli, $ruacli, $residcli, $telcli, $emailcli);
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