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

// Validar que se recibió el parámetro por GET
if (!isset($_GET['ID_Reclamacion'])) {
    die("ID_Reclamacion no proporcionado.");
}

// Sanitizar el parámetro
$ID_Reclamacion = mysqli_real_escape_string($conn, $_GET['ID_Reclamacion']);

// Consultar la reclamación
$sql = "SELECT * FROM Reclamaciones WHERE ID_Reclamacion = $ID_Reclamacion";
$resultado = mysqli_query($conn, $sql);

if (!$resultado || mysqli_num_rows($resultado) === 0) {
    die("No se encontró la reclamación con ID: $ID_Reclamacion");
}

$fila = mysqli_fetch_assoc($resultado);

$ID_Factura = $fila['ID_Factura'];
$Motivo = $fila['Motivo'];
$Detalles_Reclamacion = $fila['Detalles_Reclamacion'];
$Fecha = $fila['Fecha'];

// Consulta para llenar el desplegable de facturas
$sql_facturas = "SELECT F.ID_Factura, F.ID_Cliente, C.Nombre, C.Primer_Apellido, C.Documento
                 FROM Facturas F
                 JOIN Clientes C ON F.ID_Cliente = C.ID_Cliente";
$resultado_facturas = mysqli_query($conn, $sql_facturas);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Reclamación</title>
</head>
<body>
    <form action="actualizar_reclamacion.php" method="POST">
        <input type="hidden" name="ID_Reclamacion" value="<?php echo $ID_Reclamacion; ?>">

        <!-- Desplegable de Facturas -->
        <label for="ID_Factura">Seleccionar factura:</label><br>
        <select name="ID_Factura" id="ID_Factura" required>
            <option value="">Seleccione una factura</option>
            <?php while($factura = mysqli_fetch_assoc($resultado_facturas)): ?>
                <option value="<?php echo $factura['ID_Factura']; ?>"
                    <?php if($factura['ID_Factura'] == $ID_Factura) echo 'selected'; ?>>
                    Factura #<?php echo $factura['ID_Factura']; ?> - Cliente #<?php echo $factura['ID_Cliente']; ?> -
                    <?php echo $factura['Nombre'] . " " . $factura['Primer_Apellido']; ?> - Doc: <?php echo $factura['Documento']; ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <!-- Motivo -->
        <label for="Motivo">Motivo:</label>
        <input type="text" id="Motivo" name="Motivo" value="<?php echo $Motivo; ?>" required><br><br>

        <!-- Detalles -->
        <label for="Detalles_Reclamacion">Detalles de la Reclamación:</label><br>
        <textarea id="Detalles_Reclamacion" name="Detalles_Reclamacion" required><?php echo $Detalles_Reclamacion; ?></textarea><br><br>

        <!-- Fecha -->
        <label for="Fecha">Fecha:</label>
        <input type="date" id="Fecha" name="Fecha" value="<?php echo $Fecha; ?>" required><br><br>

        <input type="submit" value="Actualizar Reclamación">
    </form>
</body>
</html>
