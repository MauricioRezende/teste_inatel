<?php
$paginainterna = 1;
$perfis = ["adm"];
include("home.php");
?>
<div class="main" style="padding-left: 5%; padding-right: 5%;">
	<h2>Clientes</h2>
	<hr>
	<br />
	<?php
		include_once "./conf/connection.php";
	$sql = "select
				ID,
				NOME,
				CPF,
				CELULAR,
				EMAIL
			from USUARIO
			where PERFIL = 'cli'";
	$result = mysqli_query($conn, $sql);

	?>
	<table id="table">
		<tr>
			<th>ID</th>
			<th>Nome</th>
			<th>CPF</th>
			<th>Celular</th>
			<th>E-mail</th>
		</tr>
		
		<?php
	    while($row = mysqli_fetch_assoc($result)) {
	    	$results = $row;
	    	echo '<tr>
	    			<td>' . $results['ID'] . '</td>
					<td>' . utf8_encode($results['NOME']) . '</td>
					<td>' . $results['CPF'] . '</td>
					<td>' . $results['CELULAR'] . '</td>
					<td>' . $results['EMAIL'] . '</td>
				</tr>';
	    }
		mysqli_close($conn);
	
		if(!isset($results)){
			echo "<tr><td colspan='6'>Nenhum cliente cadastrado.</td></tr>";
		}
		?>
	</table>
</div>
<?php include("footer.php"); ?>