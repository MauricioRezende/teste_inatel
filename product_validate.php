<?php
$paginainterna = 1;
$perfis = ["adm"];
include("home.php");
?>
<div class="main" style="padding-left: 5%; padding-right: 5%;">
	<h2>Produtos</h2>
	<hr>
	<br />
	<?php
		include_once "./conf/connection.php";
	$sql = "select
				P.ID,
				P.PRECO,
				P.DESCRICAO,
				P.STATUS
			from PRODUTO P
			left outer join CARRINHO_COMPRA C on C.ID_PRODUTO = P.ID
			where C.DATA_HORA_COMPRA is null";
	$result = mysqli_query($conn, $sql);

	?>
	<table id="table">
		<tr>
			<th>ID</th>
			<th>Preço</th>
			<th>Descrição</th>
			<th>Status</th>
			<th></th>
		</tr>
		
		<?php
	    while($row = mysqli_fetch_assoc($result)) {
	    	$results = $row;
	    	echo '<tr>
	    			<td>' . $results['ID'] . '</td>
	    			<td>R$ ' . $results['PRECO'] . '</td>
					<td>' . utf8_encode($results['DESCRICAO']) . '</td>
					<td>' . $results['STATUS'] . '</td>';
			echo '<td><a href="./product_validate_edit.php?id=' . $results['ID'] . '" class="link-2">Alterar status</a></td>
				</tr>';
	    }
		mysqli_close($conn);
	
		if(!isset($results)){
			echo "<tr><td colspan='6'>Nenhum produto cadastrado.</td></tr>";
		}
		?>
	</table>
</div>
<?php include("footer.php"); ?>