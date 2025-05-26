<?php
    include '../conexion_bd.php';
    $conn = conexion_bd();

    $ID_Proveedor = $_POST['ID_Proveedor'];
    $Nombre = $_POST['Nombre'];
    $Telefono = $_POST['Telefono'];
    $Email = $_POST['Email'];

    $sql = "UPDATE Proveedores SET 
    Nombre = '$Nombre',
    Telefono = '$Telefono',
    Email = '$Email' 
    WHERE ID_Proveedor = $ID_Proveedor";

    mysqli_query($conn, $sql);
    mysqli_close($conn);

    header("Location: proveedores.php");
    exit();
?>