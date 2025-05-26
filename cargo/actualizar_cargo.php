<?php
    include '../conexion_bd.php';
    $conn = conexion_bd();

    $ID_Cargo = $_POST['ID_Cargo'];
    $Nombre_Cargo = $_POST['Nombre_Cargo'];

    $sql = "UPDATE Cargos SET 
    Nombre_Cargo = '$Nombre_Cargo' 
    WHERE ID_Cargo = $ID_Cargo";

    mysqli_query($conn, $sql);
    mysqli_close($conn);

    header("Location: cargos.php");
    exit();
?>
