<?php

    include '../conexion_bd.php';
    $conn=conexion_bd();

    // Obtener los datos del formulario
    $Documento = $_POST['Documento'];
    $ID_Tienda = $_POST['ID_Tienda'];
    $ID_Cargo = $_POST['ID_Cargo'];
    $Nombre = $_POST['Nombre'];
    $Primer_Apellido = $_POST['Primer_Apellido'];
    $Segundo_Apellido = $_POST['Segundo_Apellido'];
    $Telefono = $_POST['Telefono'];
    $Email = $_POST['Email'];

    $sql = "INSERT INTO Empleados (
    Documento, 
    ID_Tienda,
    ID_Cargo,
    Nombre, 
    Primer_Apellido, 
    Segundo_Apellido, 
    Telefono, 
    Email
    ) VALUES (
    '$Documento', 
    '$ID_Tienda',
    '$ID_Cargo',
    '$Nombre', 
    '$Primer_Apellido', 
    '$Segundo_Apellido', 
    '$Telefono', 
    '$Email'
    )";

    if(mysqli_query($conn, $sql)){
        echo "Empleado registrado correctamente.";
    } else {
        echo "Error al registrar el empleado: " . mysqli_error($conn);
    }
    mysqli_close($conn);
    header("Location: empleados.php");
    exit;
?>
