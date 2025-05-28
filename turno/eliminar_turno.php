<?php
include '../conexion_bd.php';
$conn = conexion_bd();

$ID_Turno = intval($_GET['ID_Turno']);

//Eliminar de turnos
$sql1 = "DELETE FROM Turnos WHERE ID_Turno = $ID_Turno";
mysqli_query($conn, $sql1);

header("Location: turnos.php");
exit();
?>
