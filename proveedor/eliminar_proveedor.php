<?php
include '../conexion_bd.php';
$conn = conexion_bd();

$ID_Proveedor = intval($_GET['ID_Proveedor']);

// Eliminar registros en Producto_Proveedor que dependen del proveedor
$sql1 = "DELETE FROM Producto_Proveedor WHERE ID_Proveedor = $ID_Proveedor";
mysqli_query($conn, $sql1);

// Luego eliminar el proveedor
$sql2 = "DELETE FROM Proveedores WHERE ID_Proveedor = $ID_Proveedor";
mysqli_query($conn, $sql2);

header("Location: proveedores.php");
exit();
?>
