<?php
include '../conexion_bd.php';
$conn = conexion_bd();

$ID_Ubicacion= intval($_GET['ID_Ubicacion']);

// Desvincular la ubicación las tiendas asociadas
$sql = "UPDATE Tiendas SET ID_Ubicacion = NULL WHERE ID_Ubicacion = $ID_Ubicacion";
mysqli_query($conn, $sql);

$sql = "DELETE FROM Ubicacion WHERE ID_Ubicacion = $ID_Ubicacion";
mysqli_query($conn, $sql);

header("Location: ubicaciones.php");
exit();
?>
    