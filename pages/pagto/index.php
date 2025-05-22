<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cadastro de Formas de Pagamento</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../styles/php.css">
        <link rel="shortcut icon" href="../../../assets/favicon.png" type="image/x-icon">
    </head>
    <body>
        <h2>Cadastro de Formas de Pagamento</h2>
        <a href="./php/adicionar.php" class="add"><button>Adicionar</button></a>
        <br />
        <table border="1" width="600">
            <tr>
                <th>Forma de Pagamento</th>
                <th>Taxa</th>
                <th>Ações</th>
            </tr>
        
        <?php 
            // Conexão com o banco de dados
            require("./php/conecta.php");
            // Configurar charset para evitar problemas com acentos
            $mysqli->set_charset("utf8");
            // Executar consulta SQL
            $query = $mysqli->query("SELECT * FROM tb_pagto");
            if (!$query) {
                die("Erro na consulta: " . $mysqli->error);
            }
            // Carregar consulta de registros
            while ($tabela = $query->fetch_assoc()) {
                $forma = htmlspecialchars($tabela['forma']);
                $taxa = htmlspecialchars($tabela['taxa']);
                $formaUrl = urlencode($tabela['forma']);
                echo "
                <tr>
                    <td align='center'>{$forma}</td>
                    <td align='center'>{$taxa}</td> 
                    <td width='120'>
                        <a href='./php/excluir.php?excluir={$formaUrl}'>[excluir]</a>
                        <a href='./php/alterar.php?alterar={$formaUrl}'>[alterar]</a>
                    </td>
                </tr>";
            }
        ?>
    </table>
     <button  onclick="window.location.href='../menu.html'">Voltar</button>
</body>
</html>