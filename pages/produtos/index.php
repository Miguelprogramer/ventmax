<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cadastro de Produtos</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../styles/php.css">
    </head>
    <body>
        <h2>Cadastro de Produtos</h2>
        <div class="buttons">
            <a href="./php/adicionar.php" class="add"><button>Adicionar</button></a>
            <a href="./php/pesquisar.php" class="pesq"><button>Pesquisar</button></a>
        </div>
        <br />
        <table border="1" width="600">
            <tr>
                <th>Nome do Produto</th>
                <th>Categoria do Produto</th>
                <th>Preço do Produto</th>  
                <th>Quantidade de Helices</th>
            </tr>
        
        <?php 
            // Conexão com o banco de dados
            require("./php/conecta.php");
            // Configurar charset para evitar problemas com acentos
            $mysqli->set_charset("utf8");
            // Executar consulta SQL
            $query = $mysqli->query("SELECT * FROM tb_produtos");
            if (!$query) {
                die("Erro na consulta: " . $mysqli->error);
            }
            // Carregar consulta de registros
            while ($tabela = $query->fetch_assoc()) {
                echo "
                <tr>
                    <td align='center'>{$tabela['produto']}</td>
                    <td align='center'>{$tabela['categoria']}</td>
                    <td align='center'>{$tabela['preco']}</td>
                    <td align='center'>{$tabela['helices']}</td>
                    <td width='120'>
                        <a href='./php/excluir.php?excluir={$tabela['produto']}'>[excluir]</a>
                        <a href='./php/alterar.php?alterar={$tabela['produto']}'>[alterar]</a>
                    </td>
                </tr>";
            }
        ?>
    </table>

    <button  onclick="window.location.href='../menu.html'">Voltar</button>
</body>
</html>