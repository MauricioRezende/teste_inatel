<?php
if (isset($_SESSION['ultimoclick']) && !empty($_SESSION['ultimoclick'])){
	if (isset($perfis) && !in_array($_SESSION['perfil'], $perfis)){
		session_destroy();
		?>
	    <script type="text/javascript">
			window.location = "index.php?erro=3";
	    </script>
	    <?php
	}
	
	$tempoAtual = time();
	if(($tempoAtual - $_SESSION['ultimoclick']) > '10800'){
		session_destroy();
		?>
	    <script type="text/javascript">
			window.location = "index.php?erro=2";
	    </script>
	    <?php
	}else{
		$_SESSION['ultimoclick'] = time();
	}
}else{
	session_destroy();
	?>
    <script type="text/javascript">
		window.location = "index.php?erro=2";
    </script>
    <?php
}
?>