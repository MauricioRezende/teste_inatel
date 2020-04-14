<?php
$paginainterna = 1;
$perfis = ["adm"];
include("home.php");
?>
<div class="main" style="padding-left: 5%; padding-right: 5%;">
	<h2><a href="./establishment_validate.php" class="link">Estabelecimentos</a> &nbsp;>&nbsp; Alterar status </h2>
	<hr>
	<br />
	<?php
		include_once "./conf/connection.php";
	$sql = "select
				U.ID,
				U.NOME,
				U.CNPJ,
				U.EMAIL,
				U.TELEFONE,
				U.STATUS,
				U.PERFIL,
				U.ID_CIDADE,
				C.NOME as CIDADE,
				E.NOME as ESTADO
			from USUARIO U
			left outer join CIDADES C on C.COD_CIDADES = U.ID_CIDADE
			left outer join ESTADOS E on E.COD_ESTADOS = C.ESTADOS_COD_ESTADOS
			where
				PERFIL = 'est' and
				ID = '" . $_GET["id"] . "'
			";
	$result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)) {
    	$id = $row['ID'];
    	$nome = utf8_encode($row['NOME']);
    	$cnpj = $row['CNPJ'];
    	$email = $row['EMAIL'];
    	$telefone = $row['TELEFONE'];
    	$status = $row['STATUS'];
    	$cidade = utf8_encode(ucwords(strtolower($row['CIDADE'])));
    	$estado = utf8_encode(ucwords(strtolower($row['ESTADO'])));
    }
	
	?>
	<a href="./establishment_validate.php" class="btn-voltar">Voltar</a>
	<br /><br />
	<form method="POST" action="">
		<br />
		<div class="grid-container">
			<div>
				<label for="cnpj">CNPJ</label>
				<input  id="cnpj" name="cnpj" type="text" value="<?php echo $cnpj; ?>" disabled>
			</div>
			<div>
				<label for="nome">Nome</label>
				<input  id="nome" name="nome" type="text" value="<?php echo $nome; ?>" disabled>
			</div>
			<div>
				<label for="email">E-mail</label>
				<input  id="email" name="email" type="text" value="<?php echo $email; ?>" disabled>
			</div>
			<div>
				<label for="telefone">Telefone</label>
				<input  id="telefone" name="telefone" type="text" value="<?php echo $telefone; ?>" disabled>
			</div>
			<div>
				<label for="estado">Estado:</label>
				<input  id="estado" name="estado" type="text" value="<?php echo $estado; ?>" disabled>
			</div>
			<div>
				<label for="cidade">Cidade:</label>
				<input  id="cidade" name="cidade" type="text" value="<?php echo $cidade; ?>" disabled>
			</div>
			<div>
				<label for="status">Status:</label>
				<select name="status">
					<option value="Aguardando" <?php if($status == "Aguardando"){ echo "selected"; } ?>>Aguardando</option>
					<option value="Ativo" <?php if($status == "Ativo"){ echo "selected"; } ?>>Ativo</option>
					<option value="Inativo" <?php if($status == "Inativo"){ echo "selected"; } ?>>Inativo</option>
				</select>
			</div>
			<br />
			<button class="btn" type="submit" id="botao" name="alterar">Alterar</button>
		</div>
		<br /><br />
		<?php
			if(isset($_POST["alterar"])){
				include_once "./conf/connection.php";
				$sql = "update USUARIO set
						STATUS = '" . $_POST["status"] . "'
						where id = '" . $_GET["id"] . "'";
				mysqli_query($conn, $sql);
				mysqli_close($conn);
				?>
			    <script type="text/javascript">
			    	alert("Alterado com sucesso!");
					window.location = "establishment_validate.php";
			    </script>
			    <?php
			}
			?>
	</form>
</div>
<?php include("footer.php"); ?>