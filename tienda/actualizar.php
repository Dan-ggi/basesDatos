<?php
// MANEJO DE SESIONES
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
// FIN MANEJO DE SESIONES

include '../conexion_bd.php';
$conn = conexion_bd();

$ID_Tienda = intval($_GET['ID_Tienda']);

$sql = "SELECT * FROM Tiendas WHERE ID_Tienda = $ID_Tienda";
$resultado = mysqli_query($conn, $sql);

if (!$resultado || mysqli_num_rows($resultado) === 0) {
    echo "Tienda no encontrada.";
    exit;
}

$fila = mysqli_fetch_assoc($resultado);
$Nombre_Tienda = $fila['Nombre_Tienda'];
$ID_Ubicacion = $fila['ID_Ubicacion'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Tienda</title>
</head>
<body>
    <h2>Actualizar Tienda</h2>
    <form action="actualizar_tienda.php" method="POST">
        <input type="hidden" name="ID_Tienda" value="<?php echo $ID_Tienda; ?>">

        <label for="Nombre_Tienda">Nombre de la tienda:</label>
        <input type="text" id="Nombre_Tienda" name="Nombre_Tienda" value="<?php echo $Nombre_Tienda; ?>" required><br><br>

        <label for="ID_Ubicacion">Ubicación:</label>
        <select id="ID_Ubicacion" name="ID_Ubicacion" required>
            <option value="">Seleccione ubicación</option>
            <?php
                $sql_ubicaciones = "SELECT ID_Ubicacion, Direccion, Ciudad, Barrio, Departamento FROM Ubicacion ORDER BY Direccion ASC";
                $resultado_ubicaciones = mysqli_query($conn, $sql_ubicaciones);
                while ($ubicacion = mysqli_fetch_assoc($resultado_ubicaciones)) {
                    $selected = ($ubicacion['ID_Ubicacion'] == $ID_Ubicacion) ? "selected" : "";
                    $texto_ubicacion = $ubicacion['Direccion'] . ", " .
                                       $ubicacion['Barrio'] . ", " .
                                       $ubicacion['Ciudad'] . ", " .
                                       $ubicacion['Departamento'];
                    echo "<option value='" . $ubicacion['ID_Ubicacion'] . "' $selected>$texto_ubicacion</option>";
                }
            ?>
        </select><br><br>

        <input type="submit" value="Actualizar Tienda">
    </form>
</body>
</html>

