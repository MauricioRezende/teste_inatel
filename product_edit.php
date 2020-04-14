<?php
$paginainterna = 1;
$perfis = ["est"];
include("home.php");
?>
<div class="main" style="padding-left: 5%; padding-right: 5%;">
	<h2><a href="./product.php" class="link">Produtos</a> &nbsp;>&nbsp; Editar </h2>
	<hr>
	<br />
	<?php
		include_once "./conf/connection.php";
		$sql = "select
					PRECO,
					DESCRICAO,
					STATUS
				from PRODUTO U
				where
					ID = '" . $_GET["id"] . "'
				order by ID asc";

	$result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)) {
    	$preco = $row['PRECO'];
    	$descricao = utf8_encode($row['DESCRICAO']);
    	$status = $row['STATUS'];
    }

    if($status != "Aguardando validação"){
    	session_destroy();
    	?>
		<script type="text/javascript">
			window.location = "index.php?erro=3";
	    </script>
		<?php
    }
	?>
	<a href="./product.php" class="btn-voltar">Voltar</a>
	<br /><br /><br />
	<form method="POST" action="">
		<div class="grid-container-produto">
			<div>
				<label for="preco">Preço</label>
				<input  id="preco" name="preco" type="text" class="" autocomplete="off" value="<?php if(isset($_POST["preco"])){echo $_POST["preco"]; }else{ echo $preco; } ?>">
			</div>
			<div>
				<label for="descricao">Descrição</label>
				<input  id="descricao" name="descricao" type="text" class="" autocomplete="off" value="<?php if(isset($_POST["descricao"])){echo $_POST["descricao"]; }else{ echo $descricao; }?>">
			</div>
			<div>
				<input type="submit" name="alterar" value="Alterar">
			</div>
			<br />
		</div>
		<?php
		if(isset($_POST["alterar"])){
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
				$sql = "update PRODUTO set
						PRECO = '" . $_POST["preco"] . "',
						DESCRICAO = '" . utf8_decode($_POST["descricao"]) . "'
						where ID = '" . $_GET["id"] . "'";
				mysqli_query($conn, $sql);
				?>
			    <script type="text/javascript">
			    	alert("Alterado com sucesso!");
					window.location = "product.php";
			    </script>
			    <?php
			}
		}
		?>
	</form>
</div>
<?php include("footer.php"); ?>