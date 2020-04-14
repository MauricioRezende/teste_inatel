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
			<div class="register">
				<img src="./img/Alcool.png" class="logo">
				<br /><br />
				<h2 style="color:gray">Cadastro de estabelecimento</h2>
				<form method="POST" action="">
					<br />
					<div class="grid-container">
						<div>
							<label for="cnpj">CNPJ</label>
							<input  id="cnpj" name="cnpj" type="text" class="" autocomplete="off" onchange="validar_cnpj();" onclick="validar_cnpj()" maxlength="18" value="<?php if(isset($_POST["cnpj"])){echo $_POST["cnpj"]; }?>">
						</div>
						<div>
							<label for="nome">Nome</label>
							<input  id="nome" name="nome" type="text" class="" autocomplete="off" value="<?php if(isset($_POST["nome"])){echo $_POST["nome"]; }?>">
						</div>
						<div>
							<label for="email">E-mail</label>
							<input  id="email" name="email" type="text" class="" autocomplete="off" value="<?php if(isset($_POST["email"])){echo $_POST["email"]; }?>">
						</div>
						<div>
							<label for="telefone">Telefone</label>
							<input  id="telefone" name="telefone" type="text" class="" autocomplete="off" value="<?php if(isset($_POST["telefone"])){echo $_POST["telefone"]; }?>" maxlength="12">
						</div>
						<div>
							<label for="estado">Estado:</label>
							<select name="estado" id="estado">
								<option value=""></option>
								<?php
									include_once "./conf/connection.php";
									$sql = "SELECT cod_estados, sigla, nome
											FROM estados
											ORDER BY sigla";
									$res = mysqli_query($conn, $sql);
									while ( $row = mysqli_fetch_assoc( $res ) ) {
										echo '<option value="'.$row['cod_estados'].'">'. utf8_encode(ucwords(strtolower($row['nome']))).'</option>';
									}
								?>
							</select>
						</div>
						<div>
							<label for="cidade">Cidade:</label>
							<span class="carregando">Aguarde, carregando...</span>
							<select name="cidade" id="cidade">
								<option value="">-- Escolha um estado --</option>
							</select>
						</div>
						<div>
							<label for="senha">Senha</label>
							<input  id="senha" name="senha" type="password" class="">
						</div>
						<div>
							<label for="confirmar_senha">Confirmar senha</label>
							<input  id="confirmar_senha" name="confirmar_senha" type="password" onchange="validar_senha()">
						</div>
						<br /><br />
					</div>
					<?php
						if(isset($_POST["cadastrar"])){
							$erro = array();
							if($_POST["cnpj"] == ""){
								array_push($erro,"Preencha o campo CNPJ.");
							}
							if($_POST["nome"] == ""){
								array_push($erro,"Preencha o campo Nome.");
							}
							if($_POST["email"] == ""){
								array_push($erro,"Preencha o campo E-mail.");
							}
							if($_POST["telefone"] == ""){
								array_push($erro,"Preencha o campo Telefone.");
							}
							if($_POST["estado"] == ""){
								array_push($erro,"Preencha o campo Estado.");
							}
							if($_POST["cidade"] == ""){
								array_push($erro,"Preencha o campo Cidade.");
							}
							if($_POST["senha"] == ""){
								array_push($erro,"Preencha o campo senha.");
							}
							if($_POST["confirmar_senha"] == ""){
								array_push($erro,"Preencha o campo Confirmar senha.");
							}
							if(isset($_POST["senha"]) && isset($_POST["confirmar_senha"])){
								if($_POST["senha"] != $_POST["confirmar_senha"]){
									array_push($erro,"As senhas precisam ser iguais.");		
								}
							}

							$cnpj = str_replace("/", "",str_replace(".", "", str_replace("-", "", $_POST["cnpj"])));
   
						    include_once "./conf/connection.php";
						    $sql = "select CNPJ from USUARIO where REPLACE(REPLACE(REPLACE(CNPJ,'.',''),'-',''),'/','') = '" . $cnpj . "'";
						    
						    $result = mysqli_query($conn, $sql);

						    while($row = mysqli_fetch_assoc($result)) {
						        $results = $row;
						    }

						    if(isset($results)) {
						    	array_push($erro,"CNPJ já cadastrado.");
						    }

							if(sizeof($erro) > 0){
								for ($i=0; $i < sizeof($erro); $i++) {
									echo '<div style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; border-radius: 5px; padding: 10px;">
											' . $erro[$i] . '
								            </div><br />';
								}
							}else{
								$sql = "insert into USUARIO (cnpj,nome,email,telefone,id_cidade,senha,status,perfil) 
										values(	'" . $_POST["cnpj"] . "',
												'" . utf8_decode($_POST["nome"]) . "',
												'" . $_POST["email"] . "',
												'" . $_POST["telefone"] . "',
												'" . $_POST["cidade"] . "',
												'" . md5($_POST["senha"]) . "',
												'Aguardando',
												'est');";
								mysqli_query($conn, $sql);
								?>
							    <script type="text/javascript">
							    	alert("Cadastrado com sucesso!");
									window.location = "index.php";
							    </script>
							    <?php
							}
						}
					?>
					<div id="erro"></div>
					<button class="btn" type="submit" id="botao" name="cadastrar" disabled="disabled">Cadastrar</button>
					<br /><br />
					<a href="./register_profile.php" class="link">Voltar</a>
				</form>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.4.1.min.js"  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js" type="text/javascript"></script>
		<script src="js/scripts.js" type="text/javascript"></script>
  	</body>
</html>
