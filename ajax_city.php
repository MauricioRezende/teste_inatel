<?php
	header('Content-type: text/html; charset=UTF-8');

	include_once "./conf/connection.php";

	$cod_estado = $_GET["cod_estado"];

	$cidades = array();

	$sql = "select 
				cod_cidades,
				nome
			from cidades
			where 
				estados_cod_estados= '" . $cod_estado . "'
			order by nome";

	$res = mysqli_query($conn, $sql);

	echo "<option value=''></option>";
	
	while ( $row = mysqli_fetch_assoc($res)){
		echo "<option value='" . $row['cod_cidades'] . "'>" . utf8_encode(ucwords(strtolower($row['nome']))) . "</option>";
	}
?>