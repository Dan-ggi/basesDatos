<?php
include '../conexion_bd.php';
$conn = conexion_bd();

$ID_Tienda = intval($_POST['ID_Tienda']);
$ID_Ubicacion = $_POST['ID_Ubicacion'];
$Nombre_Tienda = $_POST['Nombre_Tienda'];

$sql = "UPDATE Tiendas SET 
    ID_Ubicacion='$ID_Ubicacion', 
    Nombre_Tienda='$Nombre_Tienda' 
    WHERE ID_Tienda=$ID_Tienda";

mysqli_query($conn, $sql);
mysqli_close($conn);

header("Location: tiendas.php");
exit();
?>