<?php
include '../conexion_bd.php';
$conn = conexion_bd();

$ID_Inventario= intval($_GET['ID_Inventario']);

$sql = "DELETE FROM Inventario WHERE ID_Inventario = $ID_Inventario";
mysqli_query($conn, $sql);

header("Location: inventarios.php");
exit();
?>
    