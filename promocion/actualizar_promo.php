<?php
    include '../conexion_bd.php';
    $conn = conexion_bd();

    $ID_Promo = intval($_POST['ID_Promo']);
    $Nombre = $_POST['Nombre'];
    $Descripcion = $_POST['Descripcion'];
    $Fecha_Inicio = $_POST['Fecha_Inicio'];
    $Fecha_Fin = $_POST['Fecha_Fin'];
    $Cantidad = $_POST['Cantidad'];

    // Validar que exista el índice 'estado' en el formulario
    $estado = isset($_POST['estado']) ? intval($_POST['estado']) : 0;

    $sql = "UPDATE Promociones SET 
        Nombre='$Nombre', 
        Descripcion='$Descripcion', 
        Fecha_Inicio='$Fecha_Inicio', 
        Fecha_Fin='$Fecha_Fin', 
        estado='$estado', 
        Cantidad='$Cantidad'
        WHERE ID_Promo=$ID_Promo";

    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    header("Location: promociones.php");
    mysqli_close($conn);
?>
