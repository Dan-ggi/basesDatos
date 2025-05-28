<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

include '../conexion_bd.php';
$conn = conexion_bd();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_venta = intval($_POST['ID_Venta']);
    $id_tienda = intval($_POST['ID_Tienda']);
    $id_cliente = intval($_POST['ID_Cliente']);
    $id_metodo_pago = intval($_POST['ID_Metodo_Pago']);
    $fecha = mysqli_real_escape_string($conn, $_POST['Fecha']);
    $total = floatval($_POST['Total_Venta']);

    $sql = "UPDATE Ventas 
            SET ID_Tienda = $id_tienda, 
                ID_Cliente = $id_cliente, 
                ID_Metodo_Pago = $id_metodo_pago, 
                Fecha = '$fecha', 
                Total_Venta = $total 
            WHERE ID_Venta = $id_venta";

    if (mysqli_query($conn, $sql)) {
        header("Location: ventas.php");
        exit;
    } else {
        echo "Error al actualizar la venta: " . mysqli_error($conn);
    }
} else {
    echo "Acceso no permitido.";
}
?>

