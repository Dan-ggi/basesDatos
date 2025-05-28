<?php
// MANEJO DE SESIONES
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); // Espacio corregido
    exit;
}
// FIN MANEJO DE SESIONES

include '../conexion_bd.php';
$conn = conexion_bd();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Inventario</title>
</head>
<body>

    <!-- Formulario para registrar inventario -->
    <form action="insertar_inventario.php" method="POST">
        <label for="Cantidad_Disponible">Cantidad disponible:</label>
        <input type="text" id="Cantidad_Disponible" name="Cantidad_Disponible" required><br><br>

        <label for="Fecha_Reposicion">Fecha Reposición:</label>
        <input type="date" id="Fecha_Reposicion" name="Fecha_Reposicion" required><br><br>

        <label for="producto_id">Productos:</label><br>
        <select id="producto_id" name="ID_Producto" required>
            <option value="">Seleccione Producto</option>
            <?php
                $sql_producto = "SELECT ID_Producto, Nombre_Producto FROM Productos ORDER BY Nombre_Producto ASC";
                $resultado_producto = mysqli_query($conn, $sql_producto);
                while ($fila = mysqli_fetch_assoc($resultado_producto)) {
                    echo "<option value='" . $fila['ID_Producto'] . "'>" 
                        . $fila['Nombre_Producto'] . " - ID: " 
                        . $fila['ID_Producto'] . 
                        "</option>";
                }
            ?>
        </select><br><br>

        <input type="submit" value="Registrar Inventario">
    </form>

    <!-- Botón para volver -->
    <form>
        <input type="button" value="Volver al panel de control" onclick="location.href='../panel_control.php'">
    </form>

    <!-- Mostrar inventario -->
    <?php
        $sql_inventario = "SELECT * FROM Inventario";
        $resultados_inventario = mysqli_query($conn, $sql_inventario);
    ?>

    <table border="1">
        <thead>
            <tr>
                <th>ID inventario</th>
                <th>ID producto</th>
                <th>Cantidad disponible</th>
                <th>Fecha Reposición</th>
                <th>Eliminar</th>
                <th>Actualizar</th>
            </tr>
        </thead>
        <tbody>
            <?php while($fila = mysqli_fetch_assoc($resultados_inventario)): ?>
                <tr>
                    <td><?php echo $fila['ID_Inventario']; ?></td>
                    <td><?php echo $fila['ID_Producto']; ?></td>
                    <td><?php echo $fila['Cantidad_Disponible']; ?></td>
                    <td><?php echo $fila['Fecha_Reposicion']; ?></td>
                    <td><a href="eliminar_inventario.php?ID_Inventario=<?php echo $fila['ID_Inventario']; ?>">Eliminar</a></td>
                    <td><a href="actualizar.php?ID_Inventario=<?php echo $fila['ID_Inventario'];?>">actualizar  </href></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Cierre de sesión -->
    <a href="/empresa/login/logout.php">Cerrar Sesión</a>

</body>
</html>
