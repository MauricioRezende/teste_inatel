<div class="topnav" id="myTopnav">
    <a href="#" class="active"><?php echo $_SESSION["nome"] ?></a>
    <a href="./home.php" >Início</a>
    <a href="./alter_password.php">Alterar senha</a>
	<a href="./establishment_validate.php">Estabelecimentos</a>
	<a href="./product_validate.php">Produtos</a>
	<a href="./client.php">Clientes</a>
	<a href="./configuration.php">Configurações</a>
	<a href="./risk.php">Riscos</a>
	<a href="logout.php">Sair</a>
    <a href="javascript:void(0);" class="icon" onclick="exibir_menu()"><b>. . .</b></a>
</div>
<div class="sidebar">
	<div style="text-align: center; color: white;">
		<h2><?php echo $_SESSION["nome"]; ?></h2>
	</div>
	<br /><br />
	<hr>
	<a href="./home.php">Início</a>
	<a href="./alter_password.php">Alterar senha</a>
	<a href="./establishment_validate.php">Estabelecimentos</a>
	<a href="./product_validate.php">Produtos</a>
	<a href="./client.php">Clientes</a>
	<a href="./configuration.php">Configurações</a>
	<a href="./risk.php">Riscos</a>
	<a href="logout.php">Sair</a>
</div>
<br />
<div style="text-align: center; margin-bottom: -20px;" class="logo-mobile">
	<img src="./img/Alcool.png" width="180" class="">
</div>