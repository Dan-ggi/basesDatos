<?php
    // MANEJO DE SESIONES
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
        exit;
    }

    // INCLUIR UNA SOLA VEZ LA CONEXIÓN
    include '../conexion_bd.php';
    $conn = conexion_bd();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Empleados</title>
</head>
<body>
    <form action="insertar_empleados.php" method="POST">
        <label for="documento">Documento:</label>
        <input type="text" id="documento" name="Documento" required><br><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="Nombre" required><br><br>

        <label for="primer_apellido">Primer apellido:</label>
        <input type="text" id="primer_apellido" name="Primer_Apellido" required><br><br>

        <label for="segundo_apellido">Segundo apellido:</label>
        <input type="text" id="segundo_apellido" name="Segundo_Apellido" required><br><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="Telefono" required><br><br>

        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="Email" required><br><br>

        <label for="Tienda">Tienda:</label><br>
        <select id="tienda_id" name="ID_Tienda" required>
            <option value="">Seleccione la tienda</option>  
            <?php
                // CONSULTA PARA TIENDAS
                $sql_tiendas = "SELECT ID_Tienda, Nombre_Tienda FROM Tiendas ORDER BY Nombre_Tienda ASC";
                $resultado_tiendas = mysqli_query($conn, $sql_tiendas);
                while ($fila = mysqli_fetch_assoc($resultado_tiendas)) {
                    echo "<option value='" . $fila['ID_Tienda'] . "'>" . $fila['Nombre_Tienda'] . "</option>";
                }
            ?>
        </select>

        <br><br>

        <label for="Cargos">Cargo:</label><br>
        <select id="cargo_id" name="ID_Cargo" required>
            <option value="">Seleccione el cargo</option>  
            <?php
                // CONSULTA PARA CARGOS
                $sql_cargos = "SELECT ID_Cargo, Nombre_Cargo FROM Cargos ORDER BY Nombre_Cargo ASC";
                $resultado_cargos = mysqli_query($conn, $sql_cargos);
                while ($fila = mysqli_fetch_assoc($resultado_cargos)) {
                    echo "<option value='" . $fila['ID_Cargo'] . "'>" . $fila['Nombre_Cargo'] . "</option>";
                }
            ?>
        </select>

        <br><br>
        <input type="submit" value="Registrar Empleado">
    </form>

    <form>
        <input type="button" value="Volver al panel de control" onclick="location.href='../panel_control.php'">
    </form>

    <br><br>

    <?php
        // CARGA DE EMPLEADOS PARA MOSTRAR EN TABLA
        $sql_empleados = "SELECT * FROM Empleados";
        $resultados_empleados = mysqli_query($conn, $sql_empleados);
    ?>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Tienda</th>
                <th>ID Cargo</th>
                <th>Documento</th>
                <th>Nombre</th>
                <th>Primer Apellido</th>
                <th>Segundo Apellido</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Eliminar</th>
                <th>Actualizar</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fila = mysqli_fetch_assoc($resultados_empleados)): ?>
                <tr>
                    <td><?php echo $fila['ID_Empleado']; ?></td>
                    <td><?php echo $fila['ID_Tienda']; ?></td>
                    <td><?php echo $fila['ID_Cargo']; ?></td>
                    <td><?php echo $fila['Documento']; ?></td>
                    <td><?php echo $fila['Nombre']; ?></td>
                    <td><?php echo $fila['Primer_Apellido']; ?></td>
                    <td><?php echo $fila['Segundo_Apellido']; ?></td>
                    <td><?php echo $fila['Telefono']; ?></td>
                    <td><?php echo $fila['Email']; ?></td>
                    <td><a href="eliminar_empleado.php?ID_Empleado=<?php echo $fila['ID_Empleado']; ?>">Eliminar</a></td>
                    <td><a href="actualizar.php?ID_Empleado=<?php echo $fila['ID_Empleado']; ?>">Actualizar</a></td>
                </tr>
            <?php endwhile; ?>  
        </tbody>
    </table>

    <br>
    <a href="/empresa/login/logout.php">Cerrar Sesión</a> <!-- Corregido loguot por logout -->

</body>
</html>
