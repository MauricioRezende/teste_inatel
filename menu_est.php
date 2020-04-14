<div class="topnav" id="myTopnav">
    <a href="#" class="active"><?php echo $_SESSION["nome"] ?></a>
    <a href="./home.php" >Início</a>
    <a href="./alter_password.php">Alterar senha</a>
    <a href="./product.php">Produtos</a>
    <a href="logout.php">Sair</a>
    <a href="javascript:void(0);" class="icon" onclick="exibir_menu()"><b>. . .</b></a>
</div>
<div class="sidebar">
	<div style="text-align: center; color: white;">
		<h2><?php echo $_SESSION["nome"] ?></h2>
	</div>
	<br /><br />
	<hr>
	<a href="./home.php">Início</a>
	<a href="./alter_password.php">Alterar senha</a>
	<a href="./product.php">Produtos</a>
	<a href="logout.php">Sair</a>
</div>