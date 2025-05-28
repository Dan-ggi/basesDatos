<?php
include '../conexion_bd.php';
$conn = conexion_bd();

$id_producto_tienda = intval($_POST['id_producto_tienda']);
$ID_Tienda = $_POST['ID_Tienda'];       // <-- Asegúrate que el formulario envía este dato
$ID_Producto = $_POST['ID_Producto'];

$sql = "UPDATE Producto_Tienda SET 
    ID_Tienda='$ID_Tienda',
    ID_Producto='$ID_Producto'
WHERE id_producto_tienda=$id_producto_tienda";

if (mysqli_query($conn, $sql)) {
    header("Location: productos_tiendas.php");
    exit;
} else {
    echo "Error al actualizar: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
