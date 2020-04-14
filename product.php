<?php
$paginainterna = 1;
$perfis = ["est","adm"];
include("home.php");
?>
<div class="main" style="padding-left: 5%; padding-right: 5%;">
	<h2>Produtos</h2>
	<hr>
	<br />
	<a href="./product_new.php" class="btn">Cadastrar</a>
	<br /><br /><br />
	<?php
		include_once "./conf/connection.php";
	$sql = "select
				P.ID,
				P.PRECO,
				P.DESCRICAO,
				P.STATUS,
				C.STATUS as STATUS_COMPRA,
				C.DATA_HORA_COMPRA
			from PRODUTO P
			left outer join CARRINHO_COMPRA C on C.ID_PRODUTO = P.ID
			where P.ID_USUARIO = '" . $_SESSION["id"] . "'
			order by P.ID asc";
	$result = mysqli_query($conn, $sql);

	?>
	<table id="table">
		<tr>
			<th>ID</th>
			<th>Preço</th>
			<th>Descrição</th>
			<th>Status</th>
			<th></th>
			<th></th>
		</tr>
		
		<?php
	    while($row = mysqli_fetch_assoc($result)) {
	    	$results = $row;
	    	echo '<tr>
	    			<td>' . $results['ID'] . '</td>
	    			<td>R$ ' . $results['PRECO'] . '</td>
					<td>' . utf8_encode($results['DESCRICAO']) . '</td>';
					
					if(isset($results['STATUS_COMPRA'])){
						echo '<td>' . $results['STATUS_COMPRA'] . '</td>';
					}else{
						echo '<td>' . $results['STATUS'] . '</td>';
					}			
			if($results['STATUS'] == "Aguardando validação"){
				echo '<td><a href="./product_edit.php?id=' . $results['ID'] . '" class="link-2">Editar</a></td>';
			}else{
				echo '<td></td>';
			}

			if(!isset($results["DATA_HORA_COMPRA"])){
				?>
					<td><a href="./product_delete.php?id=<?php echo $results['ID']; ?>" onclick="return confirm('Realmente deseja excuir?');" class="link-2">Excluir</a></td>
				<?php
			}else{
				echo '<td></td>';	
			}
			
			echo	'</tr>';
	    }
		mysqli_close($conn);
	
		if(!isset($results)){
			echo "<tr><td colspan='6'>Nenhum produto cadastrado.</td></tr>";
		}
		?>
	</table>
</div>
<?php include("footer.php"); ?>