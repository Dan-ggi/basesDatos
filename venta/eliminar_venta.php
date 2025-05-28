<?php
// MANEJO DE SESIONES
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

include '../conexion_bd.php';
$conn = conexion_bd();

if (isset($_GET['ID_Venta'])) {
    $id_venta = intval($_GET['ID_Venta']);

    $sql = "DELETE FROM Ventas WHERE ID_Venta = $id_venta";

    if (mysqli_query($conn, $sql)) {
        header("Location: ventas.php"); // Asegúrate de que este sea el nombre correcto del archivo
        exit;
    } else {
        echo "Error al eliminar la venta: " . mysqli_error($conn);
    }
} else {
    echo "ID de venta no proporcionado.";
}
?>
