<?php
include '../conexion_bd.php';
$conn = conexion_bd();

$ID_Reclamacion = $_POST['ID_Reclamacion'];
$ID_Producto = $_POST['ID_Producto'];

$sql = "UPDATE Productos_Afectados SET  
    ID_Producto = '$nuevo_ID_Producto'
    WHERE ID_Reclamacion = '$ID_Reclamacion' AND ID_Producto = '$ID_Producto'";

mysqli_query($conn, $sql);
mysqli_close($conn);

header("Location: productos_afectados.php");
exit();
?>
