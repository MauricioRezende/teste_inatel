<?php
$paginainterna = 1;
$perfis = ["adm"];
include("home.php");
?>
<div class="main" style="padding-left: 5%; padding-right: 5%;">
	<h2>Configurações</h2>
	<hr>
	<br />
	<?php
		include_once "./conf/connection.php";
		$sql = "select
					PRECO_MAXIMO_PRODUTO
				from CONFIGURACAO";

	$result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)) {
    	$preco = $row['PRECO_MAXIMO_PRODUTO'];
    }
	?>
	
	<form method="POST" action="">
		<div class="grid-container-produto">
			<div>
				<label for="preco">Preço máximo do produto</label>
				<input  id="preco" name="preco" type="text" class="" autocomplete="off" value="<?php if(isset($_POST["preco"])){echo $_POST["preco"]; }else{ echo $preco; } ?>">
			</div>
			<div></div>
			<div class="">
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

			if(sizeof($erro) > 0){
				for ($i=0; $i < sizeof($erro); $i++) {
					echo '<br />
						<div style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; border-radius: 5px; padding: 10px;">
						' . $erro[$i] . '
			            </div>';
				}
			}else{
				$sql = "update CONFIGURACAO set
						PRECO_MAXIMO_PRODUTO = '" . str_replace(",",".",$_POST["preco"]) . "'";
				mysqli_query($conn, $sql);
				?>
			    <script type="text/javascript">
			    	alert("Alterado com sucesso!");
					window.location = "configuration.php";
			    </script>
			    <?php
			}
		}
		?>
	</form>
</div>
<?php include("footer.php"); ?>