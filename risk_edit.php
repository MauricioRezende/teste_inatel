<?php
$paginainterna = 1;
$perfis = ["adm"];
include("home.php");
?>
<div class="main" style="padding-left: 5%; padding-right: 5%;">
	<h2><a href="./risk.php" class="link">Riscos</a> &nbsp;>&nbsp; Editar </h2>
	<hr>
	<br />
	<?php
	include_once "./conf/connection.php";
	$sql = "select
				DESCRICAO
			from RISCO
			where
				ID = '" . $_GET["id"] . "'
			order by ID asc";

	$result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)) {
    	$descricao = utf8_encode($row['DESCRICAO']);
    }
    ?>
    <a href="./risk.php" class="btn-voltar">Voltar</a>
	<br /><br /><br />
	<form method="POST" action="">
		<div class="grid-container-produto">
			<div>
				<label for="descricao">Descrição</label>
				<input  id="descricao" name="descricao" type="text" class="" autocomplete="off" value="<?php echo $descricao; ?>">
			</div>
			<div></div>
			<div>
				<input type="submit" name="cadastrar" value="Alterar">
			</div>
			<br />
		</div>
		<?php
		if(isset($_POST["cadastrar"])){
			$erro = array();
			if($_POST["descricao"] == ""){
				array_push($erro,"Preencha o campo descrição.");
			}

			if(sizeof($erro) > 0){
				for ($i=0; $i < sizeof($erro); $i++) {
					echo '<br />
						<div style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; border-radius: 5px; padding: 10px;">
						' . $erro[$i] . '
			            </div>';
				}
			}else{
				include_once "./conf/connection.php";
				$sql = "update RISCO set descricao ='" . utf8_decode($_POST["descricao"]) . "' where ID = '" . $_GET["id"] . "'";

				mysqli_query($conn, $sql);

				mysqli_close($conn);

				?>
			    <script type="text/javascript">
			    	alert("Alterado com sucesso!");
					window.location = "risk.php";
			    </script>
			    <?php
			}
		}
		?>
	</form>
</div>
<?php include("footer.php"); ?>