<?php
include '../conexion_bd.php';
$conn = conexion_bd();

// Obtener los datos del formulario
$tienda = $_POST['ID_Tienda'];
$cliente = $_POST['ID_Cliente'];
$ID_Metodo_Pago = $_POST['ID_Metodo_Pago'];
$fecha = $_POST['Fecha'];
$total = $_POST['Total_Venta'];

// Insertar en la base de datos
$sql = "INSERT INTO Ventas (
    ID_Tienda, 
    ID_Cliente, 
    ID_Metodo_Pago, 
    Fecha, 
    Total_Venta
) VALUES (
    '$tienda', 
    '$cliente', 
    '$ID_Metodo_Pago', 
    '$fecha', 
    '$total'
)";

if (mysqli_query($conn, $sql)) {
    // Registro exitoso
    mysqli_close($conn);
    header("Location: ventas.php");
    exit;
} else {
    // Error
    echo "Error al registrar la venta: " . mysqli_error($conn);
    mysqli_close($conn);
}
?>
