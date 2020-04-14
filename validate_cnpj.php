<?php
header('Content-type: text/html; charset=UTF-8');

if (isset($_GET["cnpj"])) {
    $cnpj = str_replace("/", "",str_replace(".", "", str_replace("-", "", $_GET["cnpj"])));
    
    include_once "./conf/connection.php";
    $sql = "select CNPJ from USUARIO where REPLACE(REPLACE(REPLACE(CNPJ,'.',''),'-',''),'/','') = '" . $cnpj . "'";
    
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)) {
        $results = $row;
    }

    mysqli_close($conn);

    if (isset($results)) {
        ?>
        <div style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; border-radius: 5px; padding: 10px;">
        CNPJ já cadastrado.
        </div><br />
        <?php
    }
}
?>