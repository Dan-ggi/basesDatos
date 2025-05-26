<?php
// MANEJO DE SESIONES
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
// FIN MANEJO DE SESIONES
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Tienda</title>
</head>
<body>
    <h2>Registrar Nueva Tienda</h2>
    <form action="insertar_tiendas.php" method="POST">
        <label for="Nombre_Tienda">Nombre tienda:</label>
        <input type="text" id="Nombre_Tienda" name="Nombre_Tienda" required><br><br>

        <label for="ID_Ubicacion">Ubicación:</label>
        <select id="ID_Ubicacion" name="ID_Ubicacion" required>
            <option value="">Seleccione una ubicación</option>
            <?php
                include '../conexion_bd.php';
                $conn = conexion_bd();
                $sql_ubicaciones = "SELECT ID_Ubicacion, Direccion, Barrio, Ciudad, Departamento FROM Ubicacion ORDER BY Direccion ASC";
                $resultado_ubicaciones = mysqli_query($conn, $sql_ubicaciones);
                while ($ubicacion = mysqli_fetch_assoc($resultado_ubicaciones)) {
                    $texto = $ubicacion['Direccion'] . ", " .
                             $ubicacion['Barrio'] . ", " .
                             $ubicacion['Ciudad'] . ", " .
                             $ubicacion['Departamento'];
                    echo "<option value='" . $ubicacion['ID_Ubicacion'] . "'>$texto</option>";
                }
            ?>
        </select><br><br>

        <input type="submit" value="Registrar Tienda">
    </form>

    <form>
        <input type="button" value="Volver al panel de control" onclick="location.href='../panel_control.php'">
    </form>

    <h2>Tiendas Registradas</h2>
    <?php
        $sql_tienda = "SELECT * FROM Tiendas";
        $resultados_tienda = mysqli_query($conn, $sql_tienda);
    ?>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Ubicación</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($fila = mysqli_fetch_assoc($resultados_tienda)): ?>
                <tr>
                    <td><?php echo $fila['ID_Tienda']; ?></td>
                    <td><?php echo $fila['ID_Ubicacion']; ?></td>
                    <td><?php echo $fila['Nombre_Tienda']; ?></td>
                    <td>
                        <a href="eliminar_tienda.php?ID_Tienda=<?php echo $fila['ID_Tienda']; ?>">Eliminar</a> |
                        <a href="actualizar.php?ID_Tienda=<?php echo $fila['ID_Tienda']; ?>">Actualizar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <br>
    <a href="/empresa/login/logout.php">Cerrar Sesión</a>
</body>
</html>

