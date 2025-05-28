<?php
include '../conexion_bd.php';
$conn = conexion_bd();

$ID_Turno = intval($_POST['ID_Turno']);
$ID_Empleado = $_POST['ID_Empleado'];
$ID_Tienda = $_POST['ID_Tienda'];
$Dia = $_POST['Dia'];
$Hora_Inicio = $_POST['Hora_Inicio'];
$Hora_Fin = $_POST['Hora_Fin'];

$sql = "UPDATE Turnos SET 
    ID_Empleado='$ID_Empleado', 
    ID_Tienda='$ID_Tienda', 
    Dia='$Dia', 
    Hora_Inicio='$Hora_Inicio', 
    Hora_Fin='$Hora_Fin' 
    WHERE ID_Turno=$ID_Turno";

mysqli_query($conn, $sql);
mysqli_close($conn);

header("Location: turnos.php");
exit();
?>
