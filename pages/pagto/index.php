<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cadastro de Formas de Pagamento</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../styles/php.css">
    </head>
    <body>
        <h2>Cadastro de Formas de Pagamento</h2>
        <a href="./php/adicionar.php" class="add"><button>Adicionar</button></a>
        <br />
        <table border="1" width="600">
            <tr>
                <th>Forma de Pagamento</th>
                <th>Taxa</th>
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
                echo "
                <tr>
                    <td align='center'>{$tabela['forma']}</td>
                    <td align='center'>{$tabela['taxa']}</td> 
                    <td width='120'>
                        <a href='./php/excluir.php?excluir={$tabela['forma']}'>[excluir]</a>
                        <a href='./php/alterar.php?alterar={$tabela['forma']}'>[alterar]</a>
                    </td>
                </tr>";
            }
        ?>
    </table>
     <button  onclick="window.location.href='../menu.html'">Voltar</button>
</body>
</html>