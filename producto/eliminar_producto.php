<?php
include '../conexion_bd.php';
$conn = conexion_bd();

$ID_Producto = intval($_GET['ID_Producto']);

// 1. Eliminar relaciones en Ventas_Productos
$sql1 = "DELETE FROM Ventas_Productos WHERE ID_Producto = $ID_Producto";
mysqli_query($conn, $sql1);

// 2. Eliminar relaciones en Productos_Reclamaciones
$sql2 = "DELETE FROM Productos_Reclamaciones WHERE ID_Producto = $ID_Producto";
mysqli_query($conn, $sql2);

// 3. Eliminar relaciones en Productos_Afectados
$sql3 = "DELETE FROM Productos_Afectados WHERE ID_Producto = $ID_Producto";
mysqli_query($conn, $sql3);

// 4. Eliminar relaciones en Producto_Tienda
$sql4 = "DELETE FROM Producto_Tienda WHERE id_producto = $ID_Producto";
mysqli_query($conn, $sql4);

// 5. Finalmente, eliminar de Productos
$sql5 = "DELETE FROM Productos WHERE ID_Producto = $ID_Producto";
mysqli_query($conn, $sql5);

header("Location: productos.php");
exit();
?>
