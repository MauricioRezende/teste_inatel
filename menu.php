<?php
if($_SESSION['perfil'] == "adm"){
	include("menu_adm.php");
}else if($_SESSION['perfil'] == "cli"){
	include("menu_cli.php");
}else if($_SESSION['perfil'] == "est"){
	include("menu_est.php");
}

if(isset($paginainterna) && $paginainterna == 0){
	if($_SESSION['perfil'] == "cli"){
		include("client_risk.php");
	}else if($_SESSION['perfil'] == "est"){
		include("solicitation.php");
	}
	include("footer.php");
}else if(!isset($paginainterna)){
	if($_SESSION['perfil'] == "cli"){
		include("client_risk.php");	
	}else if($_SESSION['perfil'] == "est"){
		include("solicitation.php");
	}
	include("footer.php");
}
?>