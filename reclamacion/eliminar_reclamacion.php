<?php
    include '../conexion_bd.php';
    $conn = conexion_bd();

    $ID_Reclamacion = intval($_GET['ID_Reclamacion']);

    // Eliminar registros en Productos_Afectados
    $sql1 = "DELETE FROM Productos_Afectados WHERE ID_Reclamacion = $ID_Reclamacion";
    mysqli_query($conn, $sql1);

    // Eliminar registros en Productos_Reclamaciones
    $sql2 = "DELETE FROM Productos_Reclamaciones WHERE ID_Reclamacion = $ID_Reclamacion";
    mysqli_query($conn, $sql2);

    // Eliminar la reclamación
    $sql3 = "DELETE FROM Reclamaciones WHERE ID_Reclamacion = $ID_Reclamacion";
    mysqli_query($conn, $sql3);

    header("Location: reclamaciones.php");
    exit();
?>
