<?php
$paginainterna = 1;
$perfis = ["adm","cli","est"];
include("home.php");
?>
<div class="main" style="padding-left: 5%; padding-right: 5%;">
	<h2>Alterar senha</h2>
	<hr>
	<br />
	<a href="./home.php" class="btn-voltar">Voltar</a>
	<br /><br /><br />
	<form method="POST" action="">
		<div class="grid-container">
			<div>
				<label for="senha">Senha</label>
				<input  id="senha" name="senha" type="password" class="">
			</div>
			<div>
				<label for="confirmar_senha">Confirmar senha</label>
				<input  id="confirmar_senha" name="confirmar_senha" type="password">
			</div>
			<div>
				<input type="submit" name="cadastrar" value="Cadastrar">
			</div>
			<br />
		</div>
		<?php
		if(isset($_POST["cadastrar"])){
			$erro = array();
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

			if(sizeof($erro) > 0){
				for ($i=0; $i < sizeof($erro); $i++) {
					echo '<br />
						<div style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; border-radius: 5px; padding: 10px;">
						' . $erro[$i] . '
			            </div>';
				}
			}else{
				include_once "./conf/connection.php";
				$sql = "update USUARIO set SENHA = '" . md5($_POST["senha"]) . "' where ID = '" . $_SESSION["id"] . "'";

				mysqli_query($conn, $sql);

				mysqli_close($conn);

				?>
			    <script type="text/javascript">
			    	alert("Alterado com sucesso!");
					window.location = "home.php";
			    </script>
			    <?php
			}
		}
		?>
	</form>
</div>
<?php include("footer.php"); ?>