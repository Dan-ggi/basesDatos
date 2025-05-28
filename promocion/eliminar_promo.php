<?php
include '../conexion_bd.php';
$conn = conexion_bd();

$ID_Promo = intval($_GET['ID_Promo']);

// Eliminar productos relacionados primero
$sql1 = "DELETE FROM Promocion_Productos WHERE ID_Promo = $ID_Promo";
mysqli_query($conn, $sql1);

// Luego eliminar la promoción
$sql2 = "DELETE FROM Promociones WHERE ID_Promo = $ID_Promo";
mysqli_query($conn, $sql2);

header("Location: promociones.php");
exit();
?>
