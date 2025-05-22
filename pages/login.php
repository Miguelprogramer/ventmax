<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login-VentMax</title>
	<link rel="shortcut icon" href="../assets/favicon.png" type="image/x-icon">
	<link rel="stylesheet" href="../styles/php.css">
</head>
<body>
	<h2>Login</h2>
	<form method="POST" action="login.php">
		Usuário: <input type="text" name="usuario" size="30" maxlength="25" placeholder="digite o usuário">
		<br/>
		Senha: <input type="password" name="senha" size="20" maxlength="15" placeholder="digite a senha">		
		<input type="submit" value="pesquisar" name="botao">
	</form>

	<?php
	if(isset($_POST["botao"])){
		$usuario = $_POST["usuario"];
		$senha = $_POST["senha"];

		if($usuario === "admin" && $senha === "1234"){
			header("Location: menu.html");
			exit;
		} else {
			header("Location: compra.php");
		}
	}
	?>
</body>
</html>
