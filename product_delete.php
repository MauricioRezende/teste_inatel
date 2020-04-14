<?php
session_start();

$id = $_GET["id"];

include_once "./conf/connection.php";

$sql = "select
			ID_USUARIO
		from PRODUTO
		where
			ID = '" . $id . "' and ID_USUARIO = '" . $_SESSION["id"] . "'";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
	$results = $row;
}

if(!isset($results)){
 	?>
	<script type="text/javascript">
		window.location = "index.php?erro=3";
    </script>
	<?php
	session_destroy();
}else{
	$sql = "delete from PRODUTO where id = '" . $id . "'";
	echo $sql;
	mysqli_query($conn, $sql);
	?>
	<script type="text/javascript">
		window.location = "product.php";
    </script>
	<?php
}
?>