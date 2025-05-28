<?php
include '../conexion_bd.php';
$conn = conexion_bd();

$ID_Factura = intval($_GET['ID_Factura']);

// Obtener las reclamaciones relacionadas con esta factura
$sqlReclamaciones = "SELECT ID_Reclamacion FROM Reclamaciones WHERE ID_Factura = $ID_Factura";
$result = mysqli_query($conn, $sqlReclamaciones);

while ($row = mysqli_fetch_assoc($result)) {
    $idReclamacion = $row['ID_Reclamacion'];

    // Eliminar productos relacionados a cada reclamación
    mysqli_query($conn, "DELETE FROM Productos_Afectados WHERE ID_Reclamacion = $idReclamacion");
    mysqli_query($conn, "DELETE FROM Productos_Reclamaciones WHERE ID_Reclamacion = $idReclamacion");
}

// Eliminar reclamaciones asociadas a la factura
mysqli_query($conn, "DELETE FROM Reclamaciones WHERE ID_Factura = $ID_Factura");

// Eliminar compras asociadas a la factura
mysqli_query($conn, "DELETE FROM Compras_Clientes WHERE ID_Factura = $ID_Factura");

// Eliminar la factura
mysqli_query($conn, "DELETE FROM Facturas WHERE ID_Factura = $ID_Factura");

mysqli_close($conn);
header("Location: facturas.php");
exit();
?>
