<?php
    include '../conexion_bd.php';
    $conn = conexion_bd();

    // Obtener los datos del formulario
    $Nombre_Cargo = $_POST['Nombre_Cargo'];

    // Consulta corregida (sin la coma después de Nombre_Cargo)
    $sql = "INSERT INTO Cargos (
        Nombre_Cargo
    ) VALUES (
        '$Nombre_Cargo'
    )";

    if (mysqli_query($conn, $sql)) {
        echo "Cargo registrado correctamente.";
    } else {
        echo "Error al registrar el cargo: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    header("Location: cargos.php");
    exit;
?>

