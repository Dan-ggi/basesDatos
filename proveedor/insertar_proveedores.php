<?php
    include '../conexion_bd.php';
    $conn = conexion_bd();

    // Obtener los datos del formulario
    $Nombre = $_POST['Nombre'];

    // Consulta corregida (sin la coma después de Nombre_Cargo)
    $sql = "INSERT INTO Proveedores (
        Nombre
    ) VALUES (
        '$Nombre'
    )";

    if (mysqli_query($conn, $sql)) {
        echo "Proveedor registrado correctamente.";
    } else {
        echo "Error al registrar el proveedor: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    header("Location: proveedores.php");
    exit;
?>
