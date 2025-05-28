<?php
include '../conexion_bd.php';
$conn = conexion_bd();

$id_producto_tienda= intval($_GET['id_producto_tienda']);

$sql = "DELETE FROM Producto_Tienda WHERE id_producto_tienda = $id_producto_tienda";
mysqli_query($conn, $sql);

header("Location: productos_tiendas.php");
exit();
?>
    