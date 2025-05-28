<?php

    include '../conexion_bd.php';
    $conn=conexion_bd();

    // Obtener los datos del formulario
    $ID_cliente = $_POST['ID_Cliente'];
    $ID_factura = $_POST['ID_Factura'];
    $Cantidad_compras = $_POST['Cantidad_compras'];

    $sql = "INSERT INTO Compras_Clientes (
        ID_Cliente, 
        ID_Factura, 
        Cantidad_compras
    ) VALUES (
        '$ID_cliente', 
        '$ID_factura', 
        '$Cantidad_compras'
    )";

    if(mysqli_query($conn, $sql)){
        echo "Compra registrada correctamente.";
    } else {
        echo "Error al registrar la compra: " . mysqli_error($conn);
    }
    mysqli_close($conn);
    header("Location: compras_clientes.php");
    exit;
?>