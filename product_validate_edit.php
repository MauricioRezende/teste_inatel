<?php
$paginainterna = 1;
$perfis = ["adm"];
include("home.php");
?>
<div class="main" style="padding-left: 5%; padding-right: 5%;">
	<h2><a href="./product_validate.php" class="link">Produtos</a> &nbsp;>&nbsp; Alterar status </h2>
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
					ID = '" . $_GET["id"] . "'";

	$result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)) {
    	$preco = $row['PRECO'];
    	$descricao = utf8_encode($row['DESCRICAO']);
    	$status = $row['STATUS'];
    }
	?>
	<a href="./product_validate.php" class="btn-voltar">Voltar</a>
	<br /><br /><br />
	<form method="POST" action="">
		<div class="grid-container-produto">
			<div class="preco">
				<label for="preco">Preço</label>
				<input  id="preco" name="preco" type="text" disabled="" value="<?php echo $preco; ?>">
			</div>
			<div class="descricao">
				<label for="descricao">Descrição</label>
				<input  id="descricao" name="descricao" type="text" disabled="" value="<?php echo $descricao; ?>">
			</div>
			<div class="preco">
				<label for="status">Status:</label>
				<select name="status">
					<option value="Aguardando" <?php if($status == "Aguardando"){ echo "selected"; } ?>>Aguardando</option>
					<option value="Ativo" <?php if($status == "Ativo"){ echo "selected"; } ?>>Ativo</option>
					<option value="Inativo" <?php if($status == "Inativo"){ echo "selected"; } ?>>Inativo</option>
				</select>
				<input type="submit" name="alterar" value="Alterar">
			</div>
		</div>
		<br /><br />
		<?php
		if(isset($_POST["alterar"])){
			$erro = array();
			
			if(sizeof($erro) > 0){
				for ($i=0; $i < sizeof($erro); $i++) {
					echo '<br />
						<div style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; border-radius: 5px; padding: 10px;">
						' . $erro[$i] . '
			            </div>';
				}
			}else{
				include_once "./conf/connection.php";
				$sql = "update PRODUTO set
						STATUS = '" . $_POST["status"] . "'
						where ID = '" . $_GET["id"] . "'";
				mysqli_query($conn, $sql);
				?>
			    <script type="text/javascript">
			    	alert("Alterado com sucesso!");
					window.location = "product_validate.php";
			    </script>
			    <?php
			}
		}
		?>
	</form>
</div>
<?php include("footer.php"); ?>