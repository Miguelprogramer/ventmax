<?php 
require("conecta.php");

$produto = "";
$categoria = "";
$preco = "";
$helices = "";

// Verifica se o ID foi passado na URL e é válido
if (isset($_GET["alterar"])) {
    if ($produto === false || $produto <= 0) {
        exit("<p style='color:red;'>Erro: Produto inválido!</p>");
    }

    // Usa Prepared Statements para evitar SQL Injection
    $stmt = $mysqli->prepare("SELECT produto, categoria, preco, helices FROM tb_produtos WHERE produto = ?");
    $stmt->bind_param("s", $produto);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $tabela = $result->fetch_assoc();
        $produto = htmlspecialchars($tabela["produto"]);
        $categoria = htmlspecialchars($tabela["categoria"]);
        $preco = htmlspecialchars($tabela["preco"]);
        $helices = htmlspecialchars($tabela["helices"]);
    } else {
        exit("<p style='color:red;'>Erro: Produto não encontrado!</p>");
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Alterar Produto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../styles/php.css" />
    <link rel="shortcut icon" href="../../../assets/favicon.png" type="image/x-icon">
</head>
<body>
    <h2>Alterar Produto</h2>
    <form method="POST" action="alterar.php">
        Nome do Produto: <input type="text" name="produto" value="<?php echo $produto ?>" maxlength="20" placeholder="Digite o nome do produto" required>
        <br/><br/>
        Categoria do Produto: <input type="text" name="categoria" value="<?php echo $categoria ?>" maxlength="20" placeholder="Digite a categoria do produto" required>
        <br/><br/>
        Preço do Produto: <input type="number" name="preco" value="<?php echo $preco ?>" maxlength="50" placeholder="Digite o preço do produto" required>
        <br/><br/>
        Quantidae de Helices: <input type="number" name="helices" value="<?php echo $helices ?>" maxlength="20" placeholder="Digite a quantidade de helices" required>
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
    $produto  = trim($_POST["produto"]);
    $categoria = trim($_POST["categoria"]);
    $preco = trim($_POST["preco"]);
    $helices = trim($_POST["helices"]);

    if (empty($produto) || empty($categoria) || empty($preco) || empty($helices)) {
        exit("<p style='color:red;'>Erro: Preencha todos os campos corretamente.</p>");
    }

    // Usa Prepared Statements para evitar SQL Injection
    $stmt = $mysqli->prepare("UPDATE tb_produtos SET produto = ?, categoria = ?, preco = ?, helices = ? WHERE produto = ?");
    $stmt->bind_param("ssss", $produto, $categoria, $preco, $helices);
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