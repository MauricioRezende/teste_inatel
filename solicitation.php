<?php
$paginainterna = 1;
$perfis = ["est"];
//include("home.php");

?>
<div class="main" style="padding-left: 5%; padding-right: 5%;">
	<h2>Pedidos</h2>
	<hr>
	<br />
	<?php
	include_once "./conf/connection.php";
	$sql = "select
				C.ID,
				P.PRECO,
				P.DESCRICAO,
				U.NOME,
				C.STATUS,
				C.DATA_HORA_COMPRA
			from CARRINHO_COMPRA C
			left outer join PRODUTO P on P.ID = C.ID_PRODUTO
			left outer join USUARIO U on U.ID = P.ID_USUARIO
			where P.ID_USUARIO = '" . $_SESSION["id"] . "' and C.DATA_HORA_COMPRA is not null";

	$result = mysqli_query($conn, $sql);

	?>
	<table id="table">
		<tr>
			<th>ID</th>
			<th>Produto</th>
			<th>Preço</th>
			<th>Data - hora da compra</th>
			<th>Status</th>
			<th></th>
		</tr>

		<?php
		$cont = 0;
	    while($row = mysqli_fetch_assoc($result)) {
	    	$cont++;
	    	$results = $row;

	    	$data_hora = explode(" ", $results['DATA_HORA_COMPRA']);
	    	
	    	$data = explode("-", $data_hora[0]);
	    	$data =  $data[2] . "/" . $data[1] . "/" . $data[0];

	    	$hora = explode(":", $data_hora[1]);
	    	$hora= $hora[0] . ":" . $hora[1];

	    	echo '<tr>
	    			<td>' . $results['ID'] . '</td>
					<td>' . utf8_encode($results['DESCRICAO']) . '</td>
					<td>' . $results['PRECO'] . '</td>
					<td>' . $data . " - " . $hora .  '</td>
					<td>' . $results['STATUS'] . '</td>
					<td><a href="./solicitation_edit.php?id=' . $results["ID"] . '" class="link-2">Alterar status</a></td>
				</tr>';
	    }
		mysqli_close($conn);
	
		if(!isset($results)){
			echo "<tr><td colspan='6'>Nenhum pedido realizado.</td></tr>";
		}
		?>
	</table>
</div>
<?php include("footer.php"); ?>	