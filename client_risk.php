<?php
$paginainterna = 1;
$perfis = ["cli"];
//include("home.php");
?>
<div class="main" style="padding-left: 5%; padding-right: 5%;">
	<h2>Riscos</h2>
	<hr>
	<br />
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
			<th>Tenho o risco ?</th>
		</tr>
		
		<?php
	    while($row = mysqli_fetch_assoc($result)) {
	    	$results = $row;

			$sql = "select
						R.ID
					from USUARIO_RISCO R
					left outer join USUARIO U on U.ID = R.ID_USUARIO
					where R.ID_RISCO = '" . $row["ID"] . "' and R.ID_USUARIO = '" . $_SESSION["id"] ."'";
			$result2 = mysqli_query($conn, $sql);
			$cont = 0;
			while($row2 = mysqli_fetch_assoc($result2)) {
	    		$cont++;
	    	}

	    	echo '<tr>
	    			<td>' . $results['ID'] . '</td>
					<td>' . utf8_encode($results['DESCRICAO']) . '</td>';
			
			if($cont == 0){
				echo '<td><b style="color:green;">Não</b> &nbsp;&nbsp; ( <a href="./client_risk_edit.php?id=' . $results['ID'] . '&alterar=sim" class="link-2">alterar</a> )</td>';
			}else{
				echo '<td><b style="color:red;">Sim</b> &nbsp;&nbsp; ( <a href="./client_risk_edit.php?id=' . $results['ID'] . '&alterar=nao" class="link-2">alterar</a> )</td>';
			}
			

			echo '</tr>';
			$cont = 0;
	    }
		mysqli_close($conn);
	
		if(!isset($results)){
			echo "<tr><td colspan='6'>Nenhum risco cadastrado.</td></tr>";
		}
		?>
	</table>
</div>
<?php include("footer.php"); ?>