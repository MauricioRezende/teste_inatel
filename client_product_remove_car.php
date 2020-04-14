<?php
session_start();

$id = $_GET["id"];

include_once "./conf/connection.php";

$sql = "delete from CARRINHO_COMPRA where ID_PRODUTO = '" . $id . "' and ID_USUARIO = '" . $_SESSION["id"] . "'";
mysqli_query($conn, $sql);

if(isset($_GET["page"]) && $_GET["page"] == "car"){
	$page = "car.php";
}else{
	$page = "client_product.php";
}
?>
<script type="text/javascript">
	window.location = "<?php echo $page; ?>";
</script>
<?php
?>