<?php

    include '../conexion_bd.php';
    $conn=conexion_bd();

    // Obtener los datos del formulario
    $Nombre = $_POST['Nombre'];
    $Descripcion = $_POST['Descripcion'];
    $Fecha_Inicio = $_POST['Fecha_Inicio'];
    $Fecha_Fin = $_POST['Fecha_Fin'];
    $estado = $_POST['estado'];
    $Cantidad = $_POST['Cantidad'];

    $sql = "INSERT INTO Promociones (
        Nombre, 
        Descripcion, 
        Fecha_Inicio, 
        Fecha_Fin, 
        estado, 
        Cantidad
    ) VALUES (
        '$Nombre', 
        '$Descripcion', 
        '$Fecha_Inicio', 
        '$Fecha_Fin', 
        '$estado', 
        '$Cantidad'
    )";

    if(mysqli_query($conn, $sql)){
        echo "Promo registrado correctamente.";
    } else {
        echo "Error al registrar la promo: " . mysqli_error($conn);
    }
    mysqli_close($conn);
    header("Location: promociones.php");
    exit;
?>
