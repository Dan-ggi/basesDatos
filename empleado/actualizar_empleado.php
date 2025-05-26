<?php
include '../conexion_bd.php';
$conn = conexion_bd();

$ID_Empleado = intval($_POST['ID_Empleado']);
$ID_Tienda = $_POST['ID_Tienda'];
$ID_Cargo = $_POST['ID_Cargo'];
$Documento = $_POST['Documento'];
$Nombre = $_POST['Nombre'];
$Primer_Apellido = $_POST['Primer_Apellido'];
$Segundo_Apellido = $_POST['Segundo_Apellido']; 
$Telefono = $_POST['Telefono'];
$Email = $_POST['Email'];

$sql = "UPDATE Empleados SET 
    Documento='$Documento', 
    ID_Tienda='$ID_Tienda',
    ID_Cargo='$ID_Cargo',
    Nombre='$Nombre', 
    Primer_Apellido='$Primer_Apellido', 
    Segundo_Apellido='$Segundo_Apellido', 
    Telefono='$Telefono', 
    Email='$Email'
    WHERE ID_Empleado=$ID_Empleado";

mysqli_query($conn, $sql);
mysqli_close($conn);

header("Location: empleados.php");
exit();
?>
