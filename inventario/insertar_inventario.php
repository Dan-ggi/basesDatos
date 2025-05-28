<?php
    include '../conexion_bd.php';
    $conn=conexion_bd();

    // Obtener los datos del formulario
    $Cantidad_Disponible = $_POST['Cantidad_Disponible'];
    $Fecha_Reposicion = $_POST['Fecha_Reposicion'];
    $ID_Producto = $_POST['ID_Producto'];

    $sql = "INSERT INTO Inventario (
        Cantidad_Disponible, 
        Fecha_Reposicion, 
        ID_Producto
    ) VALUES (
        '$Cantidad_Disponible', 
        '$Fecha_Reposicion', 
        '$ID_Producto'
    )";

    if(mysqli_query($conn, $sql)){
        echo "Inventario registrado correctamente.";
    } else {
        echo "Error al registrar el inventario: " . mysqli_error($conn);
    }
    mysqli_close($conn);
    header("Location: inventarios.php");
    exit;
?>
