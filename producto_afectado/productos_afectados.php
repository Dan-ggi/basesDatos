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
    <title>Formulario Producto Afectado</title>
</head>
<body>
    <?php
        include '../conexion_bd.php';
        $conn = conexion_bd();

        // Obtener reclamaciones para el select
        $sql_reclamaciones = "SELECT ID_Reclamacion FROM Reclamaciones";
        $res_reclamaciones = mysqli_query($conn, $sql_reclamaciones);

        // Obtener productos para el select
        $sql_productos = "SELECT ID_Producto, Nombre_Producto FROM Productos";
        $res_productos = mysqli_query($conn, $sql_productos);
    ?>

    <form action="insertar_producto_afectado.php" method="POST">
        <!-- SELECT de Reclamaciones -->
        <label for="ID_Reclamacion">Reclamación:</label><br>
        <select name="ID_Reclamacion" id="ID_Reclamacion" required>
            <option value="">Seleccione una reclamación</option>
            <?php while ($fila = mysqli_fetch_assoc($res_reclamaciones)): ?>
                <option value="<?php echo $fila['ID_Reclamacion']; ?>"><?php echo $fila['ID_Reclamacion']; ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <!-- SELECT de Productos -->
        <label for="ID_Producto">Producto:</label><br>
        <select name="ID_Producto" id="ID_Producto" required>
            <option value="">Seleccione un producto</option>
            <?php while ($fila = mysqli_fetch_assoc($res_productos)): ?>
                <option value="<?php echo $fila['ID_Producto']; ?>">
                    <?php echo $fila['Nombre_Producto']; ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <input type="submit" value="Registrar Producto Afectado">
    </form>

    <form>
        <input type="button" value="Volver al panel de control" onclick="location.href='../panel_control.php'">
    </form>

    <?php
        // Mostrar tabla actual de productos afectados
        $sql_pr = "SELECT * FROM Productos_Afectados";
        $resultados_pr = mysqli_query($conn, $sql_pr);
    ?>

    <table border="1">
        <thead>
            <tr>
                <th>ID Reclamación</th>
                <th>ID Producto</th>
            </tr>
        </thead>
        <tbody>
            <?php while($fila = mysqli_fetch_assoc($resultados_pr)): ?>
                <tr>
                    <td><?php echo $fila['ID_Reclamacion']; ?></td>
                    <td><?php echo $fila['ID_Producto']; ?></td>
                    <td>
                        <a href="eliminar_producto_afectado.php?ID_Reclamacion=<?php echo $fila['ID_Reclamacion']; ?>&ID_Producto=<?php echo $fila['ID_Producto']; ?>">Eliminar</a> |
                        <a href="actualizar.php?ID_Reclamacion=<?php echo $fila['ID_Reclamacion']; ?>&ID_Producto=<?php echo $fila['ID_Producto']; ?>">Actualizar</a>
                    </td>
                </tr>
            <?php endwhile; ?>  
        </tbody>
    </table>

    <br>
    <a href="/empresa/login/loguot.php">Cerrar Sesión</a>

</body>
</html>
