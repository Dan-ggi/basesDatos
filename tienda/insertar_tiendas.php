<?php
    include '../conexion_bd.php';
    $conn = conexion_bd();

    // Obtener los datos del formulario
    $Nombre_Tienda = $_POST['Nombre_Tienda'];

    $sql = "INSERT INTO Tiendas (
        Nombre_Tienda
    ) VALUES (
        '$Nombre_Tienda'
    )";

    if (mysqli_query($conn, $sql)) {
        echo "Tienda registrada correctamente.";
    } else {
        echo "Error al registrar la tienda: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    header("Location: tiendas.php");
    exit;
?>

