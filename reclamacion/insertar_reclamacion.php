<?php

    include '../conexion_bd.php';
    $conn=conexion_bd();

    // Obtener los datos del formulario
    $ID_Factura = $_POST['ID_Factura'];
    $Motivo = $_POST['Motivo'];
    $Detalles_Reclamacion = $_POST['Detalles_Reclamacion'];
    $Fecha = $_POST['Fecha'];

    $sql = "INSERT INTO Reclamaciones (
        ID_Factura, 
        Motivo, 
        Detalles_Reclamacion, 
        Fecha
    ) VALUES (
        '$ID_Factura', 
        '$Motivo', 
        '$Detalles_Reclamacion', 
        '$Fecha'
    )";

    if(mysqli_query($conn, $sql)){
        echo "Reclamación registrada correctamente.";
    } else {
        echo "Error al registrar la reclamación: " . mysqli_error($conn);
    }
    mysqli_close($conn);
    header("Location: reclamaciones.php");
    exit;
?>
