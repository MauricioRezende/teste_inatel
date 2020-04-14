<?php
header('Content-type: text/html; charset=UTF-8');

if (isset($_GET["cpf"])) {
    $cpf =str_replace(".", "", str_replace("-", "", $_GET["cpf"]));
    
    include_once "./conf/connection.php";
    $sql = "select NOME, PERFIL, CPF from USUARIO where REPLACE(REPLACE(CPF,'.',''),'-','') = '" . $cpf . "'";
    
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)) {
        $results = $row;
    }

    mysqli_close($conn);
    if (isset($results)) {
        ?>
        <div style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; border-radius: 5px; padding: 10px;">
        CPF já cadastrado!
        </div><br />
        <?php
    }
}
?>