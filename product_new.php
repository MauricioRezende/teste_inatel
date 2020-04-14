<?php
$paginainterna = 1;
$perfis = ["est"];
include("home.php");
?>
<div class="main" style="padding-left: 5%; padding-right: 5%;">
	<h2><a href="./product.php" class="link">Produtos</a> &nbsp;>&nbsp; Cadastrar </h2>
	<hr>
	<br />
	<a href="./product.php" class="btn-voltar">Voltar</a>
	<br /><br />
	<form method="POST" action="">
		<div class="grid-container-produto">
			<div>
				<label for="preco">Preço</label>
				<input  id="preco" name="preco" type="text" maxlength="6" class="" autocomplete="off" value="<?php if(isset($_POST["preco"])){echo $_POST["preco"]; }?>">
			</div>
			<div>
				<label for="descricao">Descrição</label>
				<input  id="descricao" name="descricao" type="text" class="" autocomplete="off" value="<?php if(isset($_POST["descricao"])){echo $_POST["descricao"]; }?>">
			</div>
			<div>
				<input type="submit" name="cadastrar" value="Cadastrar">
			</div>
			<br />
		</div>
		<?php
		if(isset($_POST["cadastrar"])){
			$erro = array();
			if($_POST["preco"] == ""){
				array_push($erro,"Preencha o campo preço.");
			}
			if($_POST["descricao"] == ""){
				array_push($erro,"Preencha o campo descrição.");
			}

			include_once "./conf/connection.php";

			$sql = "select PRECO_MAXIMO_PRODUTO from CONFIGURACAO";

			$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_assoc($result)) {
		    	$results = $row;
		    	$preco = $results['PRECO_MAXIMO_PRODUTO'];
		    }

			if(isset($results)){
				if((float)str_replace(",", ".",$_POST["preco"]) > (float)$preco){
					array_push($erro,"Preço excede o valor máximo permitido.");
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
				$sql = "insert into PRODUTO (preco,descricao,id_usuario,status)
						values(	'" . $_POST["preco"] . "',
								'" . utf8_decode($_POST["descricao"]) . "',
								'" . $_SESSION['id'] . "',
								'Aguardando validação');";
				mysqli_query($conn, $sql);

				mysqli_close($conn);

				?>
			    <script type="text/javascript">
			    	alert("Cadastrado com sucesso!");
					window.location = "product.php";
			    </script>
			    <?php
			}
		}
		?>
	</form>
</div>
<?php include("footer.php"); ?>