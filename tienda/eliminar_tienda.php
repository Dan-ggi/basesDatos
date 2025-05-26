<?php
include '../conexion_bd.php';
$conn = conexion_bd();

$ID_Tienda = intval($_GET['ID_Tienda']);

// Paso 1: Obtener los ID de los empleados de la tienda
$sql_empleados = "SELECT ID_Empleado FROM Empleados WHERE ID_Tienda = $ID_Tienda";
$result = mysqli_query($conn, $sql_empleados);

// Paso 2: Eliminar los turnos de cada empleado
while ($row = mysqli_fetch_assoc($result)) {
    $id_empleado = $row['ID_Empleado'];
    $sql_delete_turnos = "DELETE FROM Turnos WHERE ID_Empleado = $id_empleado";
    mysqli_query($conn, $sql_delete_turnos);
}

// Paso 3: Eliminar empleados de la tienda
$sql_delete_empleados = "DELETE FROM Empleados WHERE ID_Tienda = $ID_Tienda";
mysqli_query($conn, $sql_delete_empleados);

// Paso 4: Eliminar productos asignados a la tienda
$sql_delete_productos = "DELETE FROM Producto_Tienda WHERE id_tienda = $ID_Tienda";
mysqli_query($conn, $sql_delete_productos);

// Paso 5: Eliminar la tienda
$sql_delete_tienda = "DELETE FROM Tiendas WHERE ID_Tienda = $ID_Tienda";
mysqli_query($conn, $sql_delete_tienda);

// Redirigir
header("Location: tiendas.php");
exit();
?>
