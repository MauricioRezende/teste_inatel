<?php
$paginainterna = 1;
$perfis = ["adm"];
include("home.php");
?>
<div class="main" style="padding-left: 5%; padding-right: 5%;">
	<h2>Riscos</h2>
	<hr>
	<br />
	<a href="./risk_new.php" class="btn">Cadastrar</a>
	<br /><br /><br />
	<?php
		include_once "./conf/connection.php";
		$sql = "select
					P.ID,
					P.DESCRICAO
				from RISCO P";
		$result = mysqli_query($conn, $sql);

	?>
	<table id="table">
		<tr>
			<th>ID</th>
			<th>Descrição</th>
			<th></th>
			<th></th>
		</tr>
		
		<?php
	    while($row = mysqli_fetch_assoc($result)) {
	    	$results = $row;
	    	echo '<tr>
	    			<td>' . $results['ID'] . '</td>
					<td>' . utf8_encode($results['DESCRICAO']) . '</td>
					<td><a href="./risk_edit.php?id=' . $results['ID'] . '" class="link-2">Editar</a></td>'
					?>
					<td><a href="./risk_delete.php?id=<?php echo $results['ID']; ?>" class="link-2" onclick="return confirm('Realmente deseja excuir?');">Excluir</a></td>
					<?php
					echo'';
			echo '</tr>';
	    }
		mysqli_close($conn);
	
		if(!isset($results)){
			echo "<tr><td colspan='6'>Nenhum risco cadastrado.</td></tr>";
		}
		?>
	</table>
</div>
<?php include("footer.php"); ?>