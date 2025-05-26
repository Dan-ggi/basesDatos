<?php
include '../conexion_bd.php';
$conn = conexion_bd();

$ID_Empleado = intval($_GET['ID_Empleado']);

//Eliminar de turnos
$sql1 = "DELETE FROM Turnos WHERE ID_Empleado = $ID_Empleado";
mysqli_query($conn, $sql1);

//Finalmente, eliminar de Empleados
$sql = "DELETE FROM Empleados WHERE ID_Empleado = $ID_Empleado";
mysqli_query($conn, $sql);

header("Location: Empleados.php");
exit();
?>
