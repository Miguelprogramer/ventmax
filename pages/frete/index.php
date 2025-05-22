<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cadastro de Fretes</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../styles/php.css" />
        <link rel="shortcut icon" href="../../../assets/favicon.png" type="image/x-icon">
    </head>
    <body>
        <h2>Cadastro de Fretes</h2>
        <a href="./php/adicionar.php" class="add"><button>Adicionar</button></a>
        <br />
        <table border="1" width="600">
            <tr>
                <th>Método</th>
                <th>Taxa</th>
            </tr>
        
        <?php 
            // Conexão com o banco de dados
            require("./php/conecta.php");
            // Configurar charset para evitar problemas com acentos
            $mysqli->set_charset("utf8");
            // Executar consulta SQL
            $query = $mysqli->query("SELECT * FROM tb_frete");
            if (!$query) {
                die("Erro na consulta: " . $mysqli->error);
            }
            // Carregar consulta de registros
            while ($tabela = $query->fetch_assoc()) {
                echo "
                <tr>
                    <td align='center'>{$tabela['metodo']}</td>
                    <td align='center'>{$tabela['taxa']}</td>
                    <td width='120'>
                        <a href='./php/excluir.php?excluir={$tabela['idcli']}'>[excluir]</a>
                        <a href='./php/alterar.php?alterar={$tabela['idcli']}'>[alterar]</a>
                    </td>
                </tr>";
            }
        ?>
    </table>
     <button  onclick="window.location.href='../menu.html'">Voltar</button>
</body>
</html>