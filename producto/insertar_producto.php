<?php

    include '../conexion_bd.php';
    $conn=conexion_bd();

    // Obtener los datos del formulario
    $Nombre_Producto = $_POST['Nombre_Producto'];
    $Categoria = $_POST['Categoria'];
    $Subcategoria = $_POST['Subcategoria'];

    $sql = "INSERT INTO Productos (
        Nombre_Producto, 
        Categoria, 
        Subcategoria
    ) VALUES (
        '$Nombre_Producto', 
        '$Categoria', 
        '$Subcategoria'
    )";

    if(mysqli_query($conn, $sql)){
        echo "Producto registrado correctamente.";
    } else {
        echo "Error al registrar el producto: " . mysqli_error($conn);
    }
    mysqli_close($conn);
    header("Location: productos.php");
    exit;
?>
