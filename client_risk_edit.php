<?php
session_start();

$id = $_GET["id"];
$alterar = $_GET["alterar"];

include_once "./conf/connection.php";

if($alterar == "sim"){
	$sql = "insert into USUARIO_RISCO (ID_USUARIO, ID_RISCO) values('" . $_SESSION["id"] . "','" . $id . "')";
}else if($alterar == "nao"){
	$sql = "delete from USUARIO_RISCO where ID_RISCO = '" . $id . "' and ID_USUARIO = '" . $_SESSION["id"] . "'";
}

mysqli_query($conn, $sql);
?>
<script type="text/javascript">
	window.location = "home.php";
</script>
<?php
?>