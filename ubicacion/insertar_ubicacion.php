<?php
    include '../conexion_bd.php';
    $conn = conexion_bd();

    // Obtener los datos del formulario
    $Direccion = $_POST['Direccion'];
    $Ciudad = $_POST['Ciudad'];
    $Barrio = $_POST['Barrio'];
    $Departamento = $_POST['Departamento'];

    $sql = "INSERT INTO Ubicacion (
        Direccion, 
        Barrio,
        Ciudad, 
        Departamento
    ) VALUES (
        '$Direccion', 
        '$Barrio', 
        '$Ciudad', 
        '$Departamento'
    )";

    if (mysqli_query($conn, $sql)) {
        echo "Ubicación registrada correctamente.";
    } else {
        echo "Error al registrar la ubicación: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    header("Location: ubicaciones.php");
    exit;
?>

