<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Excluir Produto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../styles/styles.css" />
</head>
<body>
    <?php 
    // Verifica se o parâmetro foi passado na URL
    if(isset($_GET["excluir"])) {
        require("conecta.php");
        
        if ($produto === false || $produto <= 0) {
            echo "<p style='color:red;'>Erro: ID inválido!</p>";
        } else {
            // Utiliza Prepared Statement para evitar SQL Injection
            $stmt = $mysqli->prepare("DELETE FROM tb_produtos WHERE produto = ?");
            $stmt->bind_param("i", $idcli);
            $stmt->execute();

            // Verifica se alguma linha foi afetada (ou seja, se o ID existia)
            if ($stmt->affected_rows > 0) {
                echo "<p style='color:green;'>Excluído com sucesso!</p>";
            } else {
                echo "<p style='color:blue;'>Nenhum produto encontrado com esse nome.</p>";
            }

            // Fecha o statement e a conexão
            $stmt->close();
            $mysqli->close();
        }
    } else {
        echo "<p style='color:red;'>Erro: Nenhum produto informado.</p>";
    }
    ?>
    <br>
    <a href='../index.php'>Voltar</a>
</body>
</html>