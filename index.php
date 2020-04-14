<!doctype html>
<html lang="pt-br">
  	<head>
  		<?php header('Content-type: text/html; charset=UTF-8'); ?>
	    <meta charset="utf-8">
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <link href="img/icon.png" rel="shortcut icon" type="image/vnd.microsoft.icon">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" href="css/style.css">
	    <title>ÁLCOOL+</title>
  	</head>
  	<body class="index">
		<div class="container">
			<div class="login">
				<form method="POST" action="login.php">
					<img src="./img/Alcool.png" class="logo-index">
					<br /><br />
					<label for="usuario">Usuário (CPF ou CNPJ)</label>
					<br />
					<input  id="usuario" name="usuario" type="number" class="" autocomplete="off">
					<br />
					<label for="senha">Senha</label>
					<br />
					<input  id="senha" name="senha" type="password" class="">
					<br /><br />
					<input type="submit" value="Entrar"></input>
					<br /><br />
					<a href="register_profile.php" class="link">Deseja se cadastrar?</a>
					<?php 
					if(isset($_GET["erro"]) && $_GET["erro"] == 1){
				        echo '<br /><br />
							<div style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; border-radius: 5px; padding: 10px;">
							Usuário ou senha incorreto!
				            </div><br />';
					}elseif(isset($_GET["erro"]) && $_GET["erro"] == 2){
				        echo '<br /><br />
							<div style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; border-radius: 5px; padding: 10px;">
							Sua sessão expirou, faça login novamente!
				            </div><br />';
					}elseif(isset($_GET["erro"]) && $_GET["erro"] == 3){
				        echo '<br /><br />
							<div style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; border-radius: 5px; padding: 10px;">
							Acesso negado!
				            </div><br />';
					}elseif(isset($_GET["erro"]) && $_GET["erro"] == 4){
						echo '<br /><br />
							<div style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; border-radius: 5px; padding: 10px;">
							Preencha o campo não sou um rôbo!
				            </div><br />';
					}
					?>
				</form>
			</div>
		</div>
  	</body>
</html>