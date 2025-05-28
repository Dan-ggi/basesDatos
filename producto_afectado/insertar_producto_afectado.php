<?php

    include '../conexion_bd.php';
    $conn=conexion_bd();

    // Obtener los datos del formulario
    $ID_Reclamacion = $_POST['ID_Reclamacion'];
    $ID_Producto = $_POST['ID_Producto'];

    $sql = "INSERT INTO Productos_Afectados (
        ID_Reclamacion, 
        ID_Producto
    ) VALUES (
        '$ID_Reclamacion', 
        '$ID_Producto'
    )";

    if(mysqli_query($conn, $sql)){
        echo "Producto afecta registrado correctamente.";
    } else {
        echo "Error al registrar el producto afectado: " . mysqli_error($conn);
    }
    mysqli_close($conn);
    header("Location: productos_afectados.php");
    exit;
?>
