<?php
    include '../conexion_bd.php';
    $conn=conexion_bd();

    // Obtener los datos del formulario
    $ID_Empleado = $_POST['ID_Empleado'];
    $ID_Tienda = $_POST['ID_Tienda'];
    $Dia = $_POST['Dia'];
    $Hora_Inicio = $_POST['Hora_Inicio'];
    $Hora_Fin = $_POST['Hora_Fin'];

    $sql = "INSERT INTO Turnos (
    ID_Empleado,
    ID_Tienda,
    Dia,
    Hora_Inicio,
    Hora_Fin
    ) VALUES (
    '$ID_Empleado',
    '$ID_Tienda',
    '$Dia',
    '$Hora_Inicio',
    '$Hora_Fin'
    )";


    if(mysqli_query($conn, $sql)){
        echo "Turno registrado correctamente.";
    } else {
        echo "Error al registrar el turno: " . mysqli_error($conn);
    }
    mysqli_close($conn);
    header("Location: turnos.php");
    exit;
?>
