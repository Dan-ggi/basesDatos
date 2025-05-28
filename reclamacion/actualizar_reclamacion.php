<?php
    include '../conexion_bd.php';
    $conn=conexion_bd();

    $ID_Reclamacion = intval($_POST['ID_Reclamacion']);
    $ID_Factura = $_POST['ID_Factura'];
    $Motivo = $_POST['Motivo'];
    $Detalles_Reclamacion = $_POST['Detalles_Reclamacion'];
    $Fecha = $_POST['Fecha'];

    echo $sql = "UPDATE Reclamaciones SET 
        ID_Factura='$ID_Factura', 
        Motivo='$Motivo', 
        Detalles_Reclamacion='$Detalles_Reclamacion', 
        Fecha='$Fecha' 
    WHERE ID_Reclamacion=$ID_Reclamacion";

    mysqli_query($conn, $sql);
    header("Location: reclamaciones.php");
    mysqli_close($conn);

?>