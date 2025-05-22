<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cadastro de Clientes</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../styles/php.css">
        <link rel="shortcut icon" href="../../assets/favicon.png" type="image/x-icon">
    </head>
    <body>
        <h1 class="title">Cadastros de Clientes</h1>
        
        <div class="buttons">
            <a href="./php/adicionar.php" class="add"><button>Adicionar</button></a>
            <a href="./php/pesquisar.php" class="pesq"><button>Pesquisar</button></a>
        </div>

        <table width="1000">
            <tr>
                <th>Nome Completo</th>
                <th>CPF</th>
                <th>Cidade</th>  
                <th>Bairro</th>
                <th>Rua</th>
                <th>N° da Residência</th>     
                <th>Telefone</th>
                <th>Email</th>
            </tr>
        
        <?php 
            // Conexão com o banco de dados
            require("./php/conecta.php");
            // Configurar charset para evitar problemas com acentos
            $mysqli->set_charset("utf8");
            // Executar consulta SQL
            $query = $mysqli->query("SELECT * FROM tb_clientes");
            if (!$query) {
                die("Erro na consulta: " . $mysqli->error);
            }
            // Carregar consulta de registros
            while ($tabela = $query->fetch_assoc()) {
                echo "
                <tr>
                    <td align='center'>{$tabela['nomecli']}</td>
                    <td align='center'>{$tabela['cpfcli']}</td>
                    <td align='center'>{$tabela['cidadecli']}</td>
                    <td align='center'>{$tabela['bairrocli']}</td>
                    <td align='center'>{$tabela['ruacli']}</td>
                    <td align='center'>{$tabela['residcli']}</td>
                    <td align='center'>{$tabela['telcli']}</td>
                    <td align='center'>{$tabela['emailcli']}</td> 
                    <td width='120'>
                        <a href='./php/excluir.php?excluir={$tabela['cpfcli']}'>[excluir]</a>
                        <a href='./php/alterar.php?alterar={$tabela['cpfcli']}'>[alterar]</a>
                    </td>
                </tr>";
            }
        ?>
    </table>
    <button  onclick="window.location.href='../menu.html'">Voltar</button>

</body>
</html>