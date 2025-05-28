<?php
// MANEJO DE SESIONES
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

include '../conexion_bd.php';
$conn = conexion_bd();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Turno</title>
</head>
<body>
    <form action="insertar_turno.php" method="POST">
        <!-- Empleado -->
        <label for="empleado_id">Empleado:</label><br>
        <select id="empleado_id" name="ID_Empleado" required>
            <option value="">Seleccione el empleado</option>
            <?php
                $sql_empleados = "SELECT ID_Empleado, Nombre FROM Empleados ORDER BY Nombre ASC";
                $resultado_empleados = mysqli_query($conn, $sql_empleados);

                if (!$resultado_empleados) {
                    echo "<option>Error al obtener empleados: " . mysqli_error($conn) . "</option>";
                } elseif (mysqli_num_rows($resultado_empleados) == 0) {
                    echo "<option>No hay empleados registrados</option>";
                } else {
                    while ($fila = mysqli_fetch_assoc($resultado_empleados)) {
                        echo "<option value='" . $fila['ID_Empleado'] . "'>" . $fila['Nombre'] . "</option>";
                    }
                }
            ?>
        </select><br><br>

        <!-- Tienda -->
        <label for="tienda_id">Tienda:</label><br>
        <select id="tienda_id" name="ID_Tienda" required>
            <option value="">Seleccione la tienda</option>
            <?php
                $sql_tiendas = "SELECT ID_Tienda, Nombre_Tienda FROM Tiendas ORDER BY Nombre_Tienda ASC";
                $resultado_tiendas = mysqli_query($conn, $sql_tiendas);

                if (!$resultado_tiendas) {
                    echo "<option>Error al obtener tiendas: " . mysqli_error($conn) . "</option>";
                } elseif (mysqli_num_rows($resultado_tiendas) == 0) {
                    echo "<option>No hay tiendas registradas</option>";
                } else {
                    while ($fila = mysqli_fetch_assoc($resultado_tiendas)) {
                        echo "<option value='" . $fila['ID_Tienda'] . "'>" . $fila['Nombre_Tienda'] . "</option>";
                    }
                }
            ?>
        </select><br><br>

        <!-- Día -->
         <label for="dia">Día:</label><br>
        <select id="dia" name="Dia" required>
            <option value="">Seleccione el día</option>
            <option value="Lunes">Lunes</option>
            <option value="Martes">Martes</option>
            <option value="Miércoles">Miércoles</option>
            <option value="Jueves">Jueves</option>
            <option value="Viernes">Viernes</option>
            <option value="Sábado">Sábado</option>
            <option value="Domingo">Domingo</option>
        </select><br><br>

        <!-- Hora Inicio -->
        <label for="hora_inicio">Hora de inicio:</label><br>
        <input type="time" id="hora_inicio" name="Hora_Inicio" required><br><br>

        <!-- Hora Fin -->
        <label for="hora_fin">Hora de fin:</label><br>
        <input type="time" id="hora_fin" name="Hora_Fin" required><br><br>

        <!-- Botón -->
        <input type="submit" value="Registrar Turno">
    </form>

    <br>

    <form>
        <input type="button" value="Volver al panel de control" onclick="location.href='../panel_control.php'">
    </form>

    <?php
        $sql_turno = "SELECT * FROM Turnos";
        $resultados_turno = mysqli_query($conn, $sql_turno);
    ?>

    <table border="1">
        <thead>
            <tr>
                <th>ID Turno</th>
                <th>ID Empleado</th>
                <th>ID Tienda</th>
                <th>Día</th>
                <th>Hora inicio</th>
                <th>Hora fin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultados_turno && mysqli_num_rows($resultados_turno) > 0):
                while($fila = mysqli_fetch_assoc($resultados_turno)):
            ?>
                <tr>
                    <td><?php echo $fila['ID_Turno']; ?></td>
                    <td><?php echo $fila['ID_Empleado']; ?></td>
                    <td><?php echo $fila['ID_Tienda']; ?></td>
                    <td><?php echo $fila['Dia']; ?></td>
                    <td><?php echo $fila['Hora_Inicio']; ?></td>
                    <td><?php echo $fila['Hora_Fin']; ?></td>
                    <td>
                        <a href="eliminar_turno.php?ID_Turno=<?php echo $fila['ID_Turno']; ?>">Eliminar</a> |
                        <a href="actualizar.php?ID_Turno=<?php echo $fila['ID_Turno']; ?>">Actualizar</a>
                    </td>
                </tr>
            <?php
                endwhile;
            else:
            ?>
                <tr>
                    <td colspan="7">No hay turnos registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <br>
    <a href="/empresa/login/logout.php">Cerrar Sesión</a>
</body>
</html>
