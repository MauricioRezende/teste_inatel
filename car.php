<?php
$paginainterna = 1;
$perfis = ["cli"];
include("home.php");

?>
<div class="main" style="padding-left: 5%; padding-right: 5%;">
	<h2><a href="./client_product.php" class="link">Produtos</a> &nbsp;>&nbsp; Carrinho </h2>
	<hr>
	<br />
	<?php
	include_once "./conf/connection.php";

	//Retorna a diferença em dias das duas ultimas compras feitas nos ultimos 15 dias
	$sql = "select 
				DATA_HORA_COMPRA as DATA,
				DATEDIFF (NOW(),DATA_HORA_COMPRA) as DIF
			from CARRINHO_COMPRA
			where
				DATA_HORA_COMPRA is not null and
				ID_USUARIO = '" . $_SESSION["id"] . "' and
				DATEDIFF (NOW(),DATA_HORA_COMPRA) < '15'
			order by id desc
			limit 2";
	$result = mysqli_query($conn, $sql);
	$data = array();
	while($row = mysqli_fetch_assoc($result)) {
    	$data[] = $row['DIF'];
    }

    $compra = 0;

    //Se foi feito DUAS compras nos últimos 15 dias
    if(sizeof($data) == 2){
    	$compra = 1;

    	//Se as duas compras foram feitas no mesmo dia
    	if($data[0] == $data[1]){
    		echo '<h3 style="color: red;">A próxima compra só podera ser feita daqui ' . (15 -$data[0]) . ' dia(s).</h3>';	
    	}else{

    		//Se as duas compras foram feitas em dias diferentes
    		if($data[0] < $data[1]){
    			echo '<h3 style="color: red;">Daqui ' . (15 -$data[1]) . ' dia(s) poderá ser feita apenas uma compra, e daqui ' . (15 - $data[0]) . ' dia(s) mais uma compra.</h3>';		
    		}else{
    			echo '<h3 style="color: red;">Daqui ' . (15 - $data[0]) . ' dia(s) poderá ser feita apenas uma compra, e daqui ' . (15 -$data[1]) . ' dia(s) mais uma compra.</h3>';		
    		}
    		
    	}
    //Se foi feito UMA compras nos últimos 15 dias
    }else if(sizeof($data) == 1){
    	echo '<h3 style="color: red;">Você pode comprar apenas um produto, ou fazer duas compras daqui ' . (15 - $data[0]) . ' dia(s).</h3>';		
    }

	?>
	<br />
	<?php
	$sql = "select
				P.ID,
				P.PRECO,
				P.DESCRICAO,
				U.NOME,
				C.STATUS
			from CARRINHO_COMPRA C
			left outer join PRODUTO P on P.ID = C.ID_PRODUTO
			left outer join USUARIO U on U.ID = P.ID_USUARIO
			where C.ID_USUARIO = '" . $_SESSION["id"] . "' and C.STATUS = 'Carrinho'";

	$result2 = mysqli_query($conn, $sql);

	?>
	<table id="table">
		<tr>
			<th>ID</th>
			<th>Estabelecimento</th>
			<th>Produto</th>
			<th></th>
			<th>Preço</th>
		</tr>
		
		<?php
		$total = 0;
		$cont = 0;
	    while($row2 = mysqli_fetch_assoc($result2)) {
	    	$cont++;
	    	$results = $row2;
	    	$total += (float)str_replace(",", ".",$row2['PRECO']);
	    	echo '<tr>
	    			<td>' . $results['ID'] . '</td>
	    			<td>' . utf8_encode($results['NOME']) . '</td>
					<td>' . utf8_encode($results['DESCRICAO']) . '</td>
					<td><a href="./client_product_remove_car.php?id=' . $results['ID'] . '&page=car" class="link-2">Remover do carrinho</a></td>
					<td>R$ ' . $results['PRECO'] . '</td>
				</tr>';
	    }
		mysqli_close($conn);
	
		if(!isset($results)){
			echo "<tr><td colspan='6'>Nenhum produto no carrinho.</td></tr>";
		}
		?>
		<tr>
			<td colspan="5" style="text-align: right;"><b>Total : R$ <?php echo str_replace(".",",",$total); ?></b></td>
		</tr>
	</table>
	<br /><br />
	<?php
	//Se não há produtos no carrinho e se não foi feita duas compras nos últimos 15 dias
	if($cont != 0 && $compra == 0){
	?>
		<div style="text-align: right;">
			<a href="./client_product_buy.php" class="btn">Comprar</a>
		</div>
	<?php
	}
	?>
</div>
<?php include("footer.php"); ?>	