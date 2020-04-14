<?php
session_start();

$id = $_GET["id"];

include_once "./conf/connection.php";

$sql = "insert into CARRINHO_COMPRA (ID_PRODUTO, ID_USUARIO, STATUS) values('" . $id . "','" . $_SESSION["id"] . "','Carrinho')";
mysqli_query($conn, $sql);
?>
<script type="text/javascript">
	window.location = "client_product.php";
</script>
<?php
?>