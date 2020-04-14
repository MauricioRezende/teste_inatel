<?php
$paginainterna = 1;
$perfis = ["adm"];
include("home.php");
?>
<div class="main" style="padding-left: 5%; padding-right: 5%;">
	<h2><a href="./risk.php" class="link">Riscos</a> &nbsp;>&nbsp; Cadastrar </h2>
	<hr>
	<br />
	<a href="./risk.php" class="btn-voltar">Voltar</a>
	<br /><br /><br />
	<form method="POST" action="">
		<div class="grid-container-produto">
			<div>
				<label for="descricao">Descrição</label>
				<input  id="descricao" name="descricao" type="text" class="" autocomplete="off" value="<?php if(isset($_POST["descricao"])){echo $_POST["descricao"]; }?>">
			</div>
			<div></div>
			<div>
				<input type="submit" name="cadastrar" value="Cadastrar">
			</div>
			<br />
		</div>
		<?php
		if(isset($_POST["cadastrar"])){
			$erro = array();
			if($_POST["descricao"] == ""){
				array_push($erro,"Preencha o campo descrição.");
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
				$sql = "insert into RISCO (descricao)
						values( '" . utf8_decode($_POST["descricao"]) . "');";

				mysqli_query($conn, $sql);

				mysqli_close($conn);

				?>
			    <script type="text/javascript">
			    	alert("Cadastrado com sucesso!");
					window.location = "risk.php";
			    </script>
			    <?php
			}
		}
		?>
	</form>
</div>
<?php include("footer.php"); ?>