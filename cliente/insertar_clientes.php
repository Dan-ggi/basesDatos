<?php

    include '../conexion_bd.php';
    $conn=conexion_bd();

    // Obtener los datos del formulario
    $Documento = $_POST['Documento'];
    $Nombre = $_POST['Nombre'];
    $Primer_Apellido = $_POST['Primer_Apellido'];
    $Segundo_Apellido = $_POST['Segundo_Apellido'];
    $Telefono = $_POST['Telefono'];
    $Email = $_POST['Email'];
    $Fecha_Nacimiento = $_POST['Fecha_Nacimiento'];

    $sql = "INSERT INTO Clientes (
        Documento, 
        Nombre, 
        Primer_Apellido, 
        Segundo_Apellido, 
        Telefono, 
        Email,  
        Fecha_Nacimiento
    ) VALUES (
        '$Documento', 
        '$Nombre', 
        '$Primer_Apellido', 
        '$Segundo_Apellido', 
        '$Telefono', 
        '$Email', 
        '$Fecha_Nacimiento' 
    )";

    if(mysqli_query($conn, $sql)){
        echo "Cliente registrado correctamente.";
    } else {
        echo "Error al registrar el cliente: " . mysqli_error($conn);
    }
    mysqli_close($conn);
    header("Location: clientes.php");
    exit;
?>
