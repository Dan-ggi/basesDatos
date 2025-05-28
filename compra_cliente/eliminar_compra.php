<?php
    include '../conexion_bd.php';
    $conn = conexion_bd();


    $ID_Compra = intval($_GET['ID_Compra']); 

    $sql = "DELETE FROM Compras_Clientes WHERE ID_Compra = $ID_Compra"; 

    mysqli_query($conn, $sql);

    header("Location: compras_clientes.php");
    exit();
?>
