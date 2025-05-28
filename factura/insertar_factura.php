<?php

    include '../conexion_bd.php';
    $conn=conexion_bd();

    // Obtener los datos del formulario
    $ID_Cliente = $_POST['ID_Cliente'];
    $Fecha = $_POST['Fecha'];
    $Monto_Total = $_POST['Monto_Total'];

    $sql = "INSERT INTO Facturas (
        ID_Cliente, 
        Fecha, 
        Monto_Total
    ) VALUES (
        '$ID_Cliente', 
        '$Fecha', 
        '$Monto_Total'
    )";

    if(mysqli_query($conn, $sql)){
        echo "Factura registrada correctamente.";
    } else {
        echo "Error al registrar la factura: " . mysqli_error($conn);
    }
    mysqli_close($conn);
    header("Location: facturas.php");
    exit;
?>
