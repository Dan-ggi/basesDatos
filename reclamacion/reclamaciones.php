<?php
// MANEJO DE SESIONES
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

// CONEXIÓN A LA BASE DE DATOS
include '../conexion_bd.php';
$conn = conexion_bd();

// CONSULTA PARA EL DESPLEGABLE DE FACTURAS
$sql_facturas = "
    SELECT f.ID_Factura, f.ID_Cliente, c.Nombre, c.Primer_Apellido, c.Documento
    FROM Facturas f
    INNER JOIN Clientes c ON f.ID_Cliente = c.ID_Cliente
    ORDER BY f.ID_Factura DESC
";
$resultado_facturas = mysqli_query($conn, $sql_facturas);

// CONSULTA PARA MOSTRAR RECLAMACIONES
$sql_reclamacion = "SELECT * FROM Reclamaciones";
$resultados_reclamacion = mysqli_query($conn, $sql_reclamacion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Reclamación   </title>
</head>
<body>

<form action="insertar_reclamacion.php" method="POST">

    <!-- Desplegable de Facturas -->
    <label for="ID_Factura">Seleccionar factura:</label><br>
    <select name="ID_Factura" id="ID_Factura" required>
        <option value="">Seleccione una factura</option>
        <?php while($factura = mysqli_fetch_assoc($resultado_facturas)): ?>
            <option value="<?php echo $factura['ID_Factura']; ?>">
                Factura #<?php echo $factura['ID_Factura']; ?> - Cliente #<?php echo $factura['ID_Cliente']; ?> -
                <?php echo $factura['Nombre'] . " " . $factura['Primer_Apellido']; ?> - Doc: <?php echo $factura['Documento']; ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <!-- Motivo -->
    <label for="Motivo">Motivo:</label>
    <input type="text" id="Motivo" name="Motivo" required><br><br>

    <!-- Detalles -->
    <label for="Detalles_Reclamacion">Detalles de la Reclamación:</label>
    <textarea id="Detalles_Reclamacion" name="Detalles_Reclamacion" required></textarea><br><br>

    <!-- Fecha -->
    <label for="Fecha">Fecha:</label>
    <input type="date" id="Fecha" name="Fecha" required><br><br>

    <!-- Botón de envío -->
    <input type="submit" value="Registrar Reclamación">
</form>

<!-- Botón para volver al panel -->
<form>
    <input type="button" value="Volver al panel de control" onclick="location.href='../panel_control.php'">
</form>

<!-- Tabla de reclamaciones -->
<h2>Reclamaciones registradas</h2>
<table border="1">
    <thead>
        <tr>
            <th>ID Reclamación</th>
            <th>ID Factura</th>
            <th>Motivo</th>
            <th>Detalles Reclamación</th>
            <th>Fecha Reclamación</th>
        </tr>
    </thead>
    <tbody>
        <?php while($fila = mysqli_fetch_assoc($resultados_reclamacion)): ?>
            <tr>
                <td><?php echo $fila['ID_Reclamacion']; ?></td>
                <td><?php echo $fila['ID_Factura']; ?></td>
                <td><?php echo $fila['Motivo']; ?></td>
                <td><?php echo $fila['Detalles_Reclamacion']; ?></td>
                <td><?php echo $fila['Fecha']; ?></td>
                <td>
                    <a href="eliminar_reclamacion.php?ID_Reclamacion=<?php echo $fila['ID_Reclamacion'];?>">Eliminar</a> |
                    <a href="actualiza.php?ID_Reclamacion=<?php echo $fila['ID_Reclamacion'];?>">Actualizar</a>
                </td>
            </tr>
        <?php endwhile; ?>  
    </tbody>
</table>

<!-- Enlace para cerrar sesión -->
<a href="/empresa/login/loguot.php">Cerrar Sesión</a>

</body>
</html>

