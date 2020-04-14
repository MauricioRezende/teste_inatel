<?php
session_start();

$id = $_GET["id"];

include_once "./conf/connection.php";

$sql = "select COUNT(ID) as CONT from USUARIO_RISCO where ID_RISCO = '" . $id . "'";
$cont = 0;
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
	$cont = $row['CONT'];
}

if($cont == 0){
	$sql = "delete from RISCO where ID = '" . $id . "'";
	mysqli_query($conn, $sql);
	?>
	<script type="text/javascript">
		window.location = "risk.php";
	</script>
	<?php
}else{
	?>
	<script type="text/javascript">
		alert("Há usuários com esse risco cadastrado.")
		window.location = "risk.php";
	</script>
	<?php
}
?>