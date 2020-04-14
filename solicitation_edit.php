<?php
$paginainterna = 1;
$perfis = ["est"];
include("home.php");
?>
<div class="main" style="padding-left: 5%; padding-right: 5%;">
	<h2><a href="./home.php" class="link">Pedidos</a> &nbsp;>&nbsp; Alterar status </h2>
	<hr>
	<br />
	<?php
		include_once "./conf/connection.php";
		$sql = "select
					P.DESCRICAO,
					C.STATUS,
					C.DATA_HORA_COMPRA
				from CARRINHO_COMPRA C
				left outer join PRODUTO P on P.ID = C.ID_PRODUTO
				where
					C.ID = '" . $_GET["id"] . "'";

	$result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)) {
    	$descricao = utf8_encode($row['DESCRICAO']);
    	$status = $row['STATUS'];
    	$data = $row['DATA_HORA_COMPRA'];
    }
	?>
	<a href="./home.php" class="btn-voltar">Voltar</a>
	<br /><br /><br />
	<form method="POST" action="">
		<div class="grid-container-produto">
			<div>
				<label for="data">Data da compra</label>
				<input  id="data" name="data" type="text" value="<?php echo $data; ?>" disabled>
			</div>
			<div>
				<label for="descricao">Descrição</label>
				<input  id="descricao" name="descricao" type="text" value="<?php echo $descricao; ?>" disabled>
			</div>
			<div>
				<label for="status">Status:</label>
				<select name="status">
					<option value="Aguardando envio" <?php if($status == "Aguardando envio"){ echo "selected"; } ?>>Aguardando envio</option>
					<option value="Produto enviado" <?php if($status == "Produto enviado"){ echo "selected"; } ?>>Produto enviado</option>
					<option value="Produto entregue" <?php if($status == "Produto entregue"){ echo "selected"; } ?>>Produto entregue</option>
				</select>
				<input type="submit" name="alterar" value="Alterar">
			</div>
		</div>
		<?php
		if(isset($_POST["alterar"])){
			include_once "./conf/connection.php";
			$sql = "update CARRINHO_COMPRA set
					STATUS = '" . utf8_decode($_POST["status"]) . "'
					where ID = '" . $_GET["id"] . "'";
			mysqli_query($conn, $sql);
			?>
		    <script type="text/javascript">
		    	alert("Alterado com sucesso!");
				window.location = "solicitation.php";
		    </script>
		    <?php
		}
		?>
	</form>
</div>
<?php include("footer.php"); ?>