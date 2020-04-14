<?php
session_start();

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
$compra = array();
while($row = mysqli_fetch_assoc($result)) {
	$compra[] = $row['DIF'];
}


//Retorna a quantidade de produtos que há no carrinho
$sql = "select COUNT(ID) as CONT from CARRINHO_COMPRA where ID_USUARIO = '" . $_SESSION["id"] . "' and STATUS = 'Carrinho'";
$cont = 0;
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
	$cont = $row['CONT'];
}

//Retorna o grau de risco do usuário que está fazendo a compra
$sql = "select COUNT(ID) as CONT from USUARIO_RISCO where ID_USUARIO = '" . $_SESSION["id"] . "'";
$risco = 0;
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
	$risco = $row['CONT'];
}

//Retorna o grau de risco dos outros usuários que estão com produtos em seu carrinho de compra
$sql = "select ID_USUARIO from CARRINHO_COMPRA where STATUS = 'Carrinho' and ID_USUARIO != '" . $_SESSION["id"] . "'";
$risco2 = 0;
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
	//Retorna o grau de risco de cada usuário que está com produtos em seu carrinho de compra
	$sql2 = "select U.ID_USUARIO,COUNT(U.ID) as CONT from USUARIO_RISCO U where U.ID_USUARIO = '" . $row["ID_USUARIO"] . "' group by U.ID_USUARIO order by CONT desc";
	$result2 = mysqli_query($conn, $sql2);
	while($row2 = mysqli_fetch_assoc($result2)) {
		if($row2["CONT"] > $risco2){
			$risco2 = $row2["CONT"];
		}
	}
}

//Ferifica se o grau de risco do usuário que está comprando é menor que o grau de risco de outros usuários
if($risco2 > $risco){
	$sql = "delete from CARRINHO_COMPRA where ID_USUARIO = '" . $_SESSION["id"] . "' and STATUS = 'Carrinho'";
	mysqli_query($conn, $sql);
	?>
		<script type="text/javascript">
			alert("Há um usuário com mais necessidade de comprar esse produto!")
			window.location = "car.php"
		</script>
	<?php
}

if(sizeof($compra) == 1){
	if($cont == 1){
		//retorn o id do produtos em meu carrinho
		$sql = "select ID_PRODUTO from CARRINHO_COMPRA where ID_USUARIO = '" . $_SESSION["id"] . "' and STATUS = 'Carrinho'";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($result)) {
			//Retorna algum produto que está em meu carrinho mas que foi comprado primeiro por outro usuário
			$sql = "select ID_PRODUTO from CARRINHO_COMPRA where ID_PRODUTO = '" . $row['ID_PRODUTO'] . "' and DATA_HORA_COMPRA is not null";
			$result2 = mysqli_query($conn, $sql);
			while($row2 = mysqli_fetch_assoc($result2)) {
				$comprado = $row['ID_PRODUTO'];
			}
			if(isset($comprado)){
				$sql = "delete from CARRINHO_COMPRA where ID_USUARIO = '" . $_SESSION["id"] . "' and STATUS = 'Carrinho'";
				mysqli_query($conn, $sql);
				?>
				<script type="text/javascript">
					alert("O produto foi comprado por outro cliente!")
					window.location = "car.php";
				</script>
				<?php		
			}
		}

		$sql = "update CARRINHO_COMPRA set STATUS = 'Aguardando envio', DATA_HORA_COMPRA = NOW() where ID_USUARIO = '" . $_SESSION["id"] . "' and STATUS = 'Carrinho'";
		mysqli_query($conn, $sql);
		?>
			<script type="text/javascript">
				alert("Compra realizada com sucesso!")
				window.location = "car.php";
			</script>
		<?php
	}else if($cont == 2){
		?>
			<script type="text/javascript">
				alert("Você pode comprar apenas um item!")
				window.location = "car.php";
			</script>
		<?php
	}
}else if(sizeof($compra) == 2){
	?>
		<script type="text/javascript">
			alert("Você pode comprar apenas um item!")
			window.location = "car.php";
		</script>
	<?php
}else{
	//retorn o id do produtos em meu carrinho
	$sql = "select ID_PRODUTO from CARRINHO_COMPRA where ID_USUARIO = '" . $_SESSION["id"] . "' and STATUS = 'Carrinho'";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result)) {
		//Retorna algum produto que está em meu carrinho mas que foi comprado primeiro por outro usuário
		$sql = "select ID_PRODUTO from CARRINHO_COMPRA where ID_PRODUTO = '" . $row['ID_PRODUTO'] . "' and DATA_HORA_COMPRA is not null";
		$result2 = mysqli_query($conn, $sql);
		while($row2 = mysqli_fetch_assoc($result2)) {
			$comprado = $row['ID_PRODUTO'];
		}
		if(isset($comprado)){
			$sql = "delete from CARRINHO_COMPRA where ID_USUARIO = '" . $_SESSION["id"] . "' and STATUS = 'Carrinho'";
			mysqli_query($conn, $sql);
			?>
			<script type="text/javascript">
				alert("O produto foi comprado por outro cliente!")
				window.location = "car.php";
			</script>
			<?php		
		}
	}
	$sql = "update CARRINHO_COMPRA set STATUS = 'Aguardando envio', DATA_HORA_COMPRA = NOW() where ID_USUARIO = '" . $_SESSION["id"] . "' and STATUS = 'Carrinho'";
	mysqli_query($conn, $sql);
	?>
		<script type="text/javascript">
			alert("Compra realizada com sucesso!")
			window.location = "car.php";
		</script>
	<?php
}
?>