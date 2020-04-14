<?php
$paginainterna = 1;
$perfis = ["cli"];
include("home.php");

include_once "./conf/connection.php";
$sql = "select COUNT(id) as cont from CARRINHO_COMPRA where id_usuario = '" . $_SESSION["id"] . "' and STATUS  = 'Carrinho'";
$result = mysqli_query($conn, $sql);
$cont = 0;
 while($row = mysqli_fetch_assoc($result)) {
	$cont = $row["cont"];
}

?>
<div class="main" style="padding-left: 5%; padding-right: 5%;">
	<div class="grid-container">
		<div class="produto">
			<h2>Produtos</h2>
		</div>
		<div class="pedido">
			<h2><a href="./car.php" class="link">Carrinho(<?php echo $cont; ?>)</a></h2>
		</div>
	</div>
	<hr>
	<br />
	<?php
	$sql = "select
				P.ID,
				P.PRECO,
				P.DESCRICAO,
				P.STATUS,
				U.NOME,
				CI.NOME as CIDADE,
				E.NOME as ESTADO
			from PRODUTO P
				left outer join USUARIO U on U.ID = P.ID_USUARIO
				left outer join CIDADES CI on CI.COD_CIDADES = U.ID_CIDADE
				left outer join ESTADOS E on E.COD_ESTADOS = CI.ESTADOS_COD_ESTADOS
			where 
				P.STATUS = 'Ativo'";
			
	if(isset($_POST["buscar"])){
		if(isset($_POST["estado"]) && $_POST["estado"] != ""){
			$sql .= " and E.COD_ESTADOS = '" . $_POST["estado"] ."'";
		}
		if(isset($_POST["cidade"]) && $_POST["cidade"] != ""){
			$sql .= " and CI.COD_CIDADES = '" . $_POST["cidade"] ."'";
		}
	}

	$sql .= " order by P.ID asc";

	$result2 = mysqli_query($conn, $sql);
	?>
	<form method="POST" action="">
		<div class="grid-container-cliente-produto">
			<div>
				<label for="estado">Estado:</label>
				<select name="estado" id="estado">
					<option value=""></option>
					<?php
						include_once "./conf/connection.php";
						$sql = "SELECT cod_estados, sigla, nome
								FROM estados
								ORDER BY sigla";
						$res = mysqli_query($conn, $sql);
						while ( $row = mysqli_fetch_assoc( $res ) ) {
							echo '<option value="'.$row['cod_estados'].'">'. utf8_encode(ucwords(strtolower($row['nome']))).'</option>';
						}
					?>
				</select>
			</div>
			<div>
				<label for="cidade">Cidade:</label>
				<span class="carregando">Aguarde, carregando...</span>
				<select name="cidade" id="cidade">
					<option value="">-- Escolha um estado --</option>
				</select>
			</div>
			<div>
				<div>&nbsp;</div>
				<input type="submit" name="buscar" value="Buscar">
			</div>
		</div>
	</form>
	<br />
	<?php

	$sql = "select PRECO_MAXIMO_PRODUTO from CONFIGURACAO";

	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result)) {
    	$preco = $row['PRECO_MAXIMO_PRODUTO'];
    }
	?>
	<i>*O preço máximo permitido para o produto é de R$ <?php echo str_replace(".",",",$preco); ?>.</i>
	<br /><br />
	<table id="table">
		<tr>
			<th>ID</th>
			<th>Estado</th>
			<th>Cidade</th>
			<th>Estabelecimento</th>
			<th>Produto</th>
			<th>Preço</th>
			<th></th>
		</tr>
		
		<?php
	    while($row2 = mysqli_fetch_assoc($result2)) {
	    	$results2 = $row2;
	    	$sql = "select 
	    				C.ID_PRODUTO,
	    				C.ID_USUARIO,
	    				C.STATUS
	    			from CARRINHO_COMPRA C
	    			where 
	    				C.ID_USUARIO = '" . $_SESSION["id"] . "' and
	    				C.ID_PRODUTO = '" . $row2["ID"] . "'";

			$result3 = mysqli_query($conn, $sql);
			$cont2 = 0;
			while($row3 = mysqli_fetch_assoc($result3)) {
				$status_compra = $row3['STATUS'];
				$cont2++;
			}

			$sql = "select 
	    				C.ID_PRODUTO,
	    				C.ID_USUARIO,
	    				C.STATUS
	    			from CARRINHO_COMPRA C
	    			where 
	    				C.DATA_HORA_COMPRA is not null and
	    				C.ID_PRODUTO = '" . $row2["ID"] . "'";

			$result4 = mysqli_query($conn, $sql);
			$comprado = 0;
			while($row3 = mysqli_fetch_assoc($result4)) {
				$comprado++;
			}

			//Se o produto não foi comprado
			if($comprado == 0){
		    	echo '<tr>
		    			<td>' . $results2['ID'] . '</td>
		    			<td>' . utf8_encode(ucwords(strtolower($results2['ESTADO']))) . '</td>
		    			<td>' . utf8_encode(ucwords(strtolower($results2['CIDADE']))) . '</td>
		    			<td>' . utf8_encode($results2['NOME']) . '</td>
		    			<td>' . utf8_encode($results2['DESCRICAO']) . '</td>
		    			<td>R$ ' . $results2['PRECO'] . '</td>';

		    	// Verifica se o produto está em meu carrinho
				if($cont2 == 0){
					if($cont < 2){
						echo '<td><a href="./client_product_add_car.php?id=' . $results2['ID'] . '" class="link-2">Adicionar ao carrinho</a></td>';
					}else{
						echo '<td></td>';
					}
				}else{
					if($status_compra != "Carrinho"){
						echo '<td></td>';	
					}else{
						echo '<td><a href="./client_product_remove_car.php?id=' . $results2['ID'] . '" class="link-2">Remover do carrinho</a></td>';
					}
				}
				
				$cont2 = 0;
			}

			echo'</tr>';
	    }
		mysqli_close($conn);
	
		if(!isset($results2)){
			echo "<tr><td colspan='7'>Nenhum produto cadastrado.</td></tr>";
		}
		?>
	</table>
</div>
<?php include("footer.php"); ?>