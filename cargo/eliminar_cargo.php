<?php
include '../conexion_bd.php';
$conn = conexion_bd();

$ID_Cargo= intval($_GET['ID_Cargo']);

$sql = "DELETE FROM Cargos WHERE ID_Cargo = $ID_Cargo";
mysqli_query($conn, $sql);

header("Location: Cargos.php");
exit();
?>
    