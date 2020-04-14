<?php
	if(!isset($_SESSION)){ 
        session_start();
    }
	
	$usuario =str_replace("/", "", str_replace(".", "", str_replace("-", "", $_POST["usuario"])));
	$senha = md5($_POST["senha"]);

	if(isset($usuario) && isset($senha)){

		include_once "./conf/connection.php";

		$sql = "select ID, NOME, PERFIL, STATUS from USUARIO 
				where (	REPLACE(REPLACE(CPF,'.',''),'-','') = '" . $usuario . "' or 
						REPLACE(REPLACE(REPLACE(CNPJ,'.',''),'-',''),'/','') = '" . $usuario . "') 
						and SENHA = '" . $senha . "'";

		$result = mysqli_query($conn, $sql);

	    while($row = mysqli_fetch_assoc($result)) {
	    	$results = $row;
	    }
	    
		mysqli_close($conn);
		if (isset($results)) {
			if($results['STATUS'] == "Aguardando" || $results['STATUS'] == "Inativo"){
				?>
				<script type="text/javascript">
					window.location = "index.php?erro=3";
			    </script>
				<?php
			}
			$_SESSION['id'] = $results['ID'];
			$_SESSION['ultimoclick'] = time();
			$_SESSION['nome'] = utf8_encode($results['NOME']);
			$_SESSION['perfil'] = $results['PERFIL'];
			?>
			<script type="text/javascript">
				window.location = "home.php";
		    </script>
			<?php
		}else{
			?>
			<script type="text/javascript">
				window.location = "index.php?erro=1";
		    </script>
			<?php
		}
	}else{
		?>
		<script type="text/javascript">
			window.location = "index.php?erro=1";
	    </script>
		<?php
	}
?>