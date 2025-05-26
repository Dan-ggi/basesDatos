<?php
include '../conexion_bd.php';
$conn = conexion_bd();

$ID_Cliente = intval($_GET['ID_Cliente']);

//Eliminar de Productos_Afectados
$sql = "DELETE FROM Productos_Afectados WHERE ID_Reclamacion IN (SELECT ID_Reclamacion FROM Reclamaciones WHERE ID_Factura IN (SELECT ID_Factura FROM Facturas WHERE ID_Cliente = $ID_Cliente))";
mysqli_query($conn, $sql);

//Eliminar de Productos_Reclamaciones
$sql = "DELETE FROM Productos_Reclamaciones WHERE ID_Reclamacion IN (SELECT ID_Reclamacion FROM Reclamaciones WHERE ID_Factura IN (SELECT ID_Factura FROM Facturas WHERE ID_Cliente = $ID_Cliente))";
mysqli_query($conn, $sql);

//Eliminar de Compras_Clientes
$sql = "DELETE FROM Compras_Clientes WHERE ID_Factura IN (SELECT ID_Factura FROM Facturas WHERE ID_Cliente = $ID_Cliente)";
mysqli_query($conn, $sql);

//Eliminar de Ventas_Productos (ventas asociadas a facturas)
$sql = "DELETE FROM Ventas_Productos WHERE ID_Venta IN (SELECT ID_Venta FROM Ventas WHERE ID_Factura IN (SELECT ID_Factura FROM Facturas WHERE ID_Cliente = $ID_Cliente))";
mysqli_query($conn, $sql);

//Eliminar de Ventas_Productos (ventas asociadas directamente al cliente)
$sql = "DELETE FROM Ventas_Productos WHERE ID_Venta IN (SELECT ID_Venta FROM Ventas WHERE ID_Cliente = $ID_Cliente)";
mysqli_query($conn, $sql);

//Eliminar de Ventas (ventas asociadas a facturas)
$sql = "DELETE FROM Ventas WHERE ID_Factura IN (SELECT ID_Factura FROM Facturas WHERE ID_Cliente = $ID_Cliente)";
mysqli_query($conn, $sql);

//Eliminar de Ventas (ventas asociadas directamente al cliente)
$sql = "DELETE FROM Ventas WHERE ID_Cliente = $ID_Cliente";
mysqli_query($conn, $sql);

//Eliminar de Reclamaciones
$sql = "DELETE FROM Reclamaciones WHERE ID_Factura IN (SELECT ID_Factura FROM Facturas WHERE ID_Cliente = $ID_Cliente)";
mysqli_query($conn, $sql);

//Eliminar de Facturas
$sql = "DELETE FROM Facturas WHERE ID_Cliente = $ID_Cliente";
mysqli_query($conn, $sql);

//Finalmente, eliminar de Clientes
$sql = "DELETE FROM Clientes WHERE ID_Cliente = $ID_Cliente";
mysqli_query($conn, $sql);

header("Location: clientes.php");
exit();
?>
