<?php
  //MANEJO DE SESIONES
  session_start();
  if(!isset($_SESSION['usuario'])){
     header("Location : login.php");
     exit;
  }
  //FIN MANEJO DE SESIONES
?>
<?php
    include '../conexion_bd.php';
    $conn = conexion_bd();

    $ID_Turno = $_GET['ID_Turno'];

    $sql="SELECT * FROM Turnos WHERE ID_Turno = $ID_Turno";
    $resultado = mysqli_query($conn, $sql);
    $fila = mysqli_fetch_assoc($resultado);

    $ID_Empleado = $fila['ID_Empleado'];
    $ID_Tienda = $fila['ID_Tienda'];
    $Dia = $fila['Dia'];
    $Hora_Inicio = $fila['Hora_Inicio'];
    $Hora_Fin = $fila['Hora_Fin'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>actualizar el turno</title>
</head>
<body>
    <form action="actualizar_turno.php" method="POST">
        <input type="hidden" name="ID_Turno" value="<?php echo $ID_Turno; ?>" hidden>
        
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
                        $selected = ($fila['ID_Empleado'] == $ID_Empleado) ? 'selected' : '';
                        echo "<option value='" . $fila['ID_Empleado'] . "' $selected>" . $fila['Nombre'] . "</option>";
                    }
                }
            ?>
        </select><br><br>

        <!-- Tienda -->
        <label for="Tienda">Tienda:</label><br>
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
                        $selected = ($fila['ID_Tienda'] == $ID_Tienda) ? 'selected' : '';
                        echo "<option value='" . $fila['ID_Tienda'] . "' $selected>" . $fila['Nombre_Tienda'] . "</option>";
                    }
                }
            ?>
        </select><br><br>


        <!-- Día -->
        <label for="dia">Día:</label><br>
        <select id="dia" name="Dia" required>
            <option value="">Seleccione el día</option>
            <?php
                $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
                foreach ($dias as $dia) {
                    echo "<option value='$dia'" . ($Dia == $dia ? " selected" : "") . ">$dia</option>";
                }
            ?>
        </select><br><br>

        <!-- Hora Inicio -->
        <label for="hora_inicio">Hora de inicio:</label><br>
        <input type="time" id="hora_inicio" name="Hora_Inicio" value="<?php echo $Hora_Inicio; ?>" required><br><br>

        <!-- Hora Fin -->
        <label for="hora_fin">Hora de fin:</label><br>
        <input type="time" id="hora_fin" name="Hora_Fin" value="<?php echo $Hora_Fin; ?>" required><br><br>

        <input type="submit" value="actualizar turno">
    </form>
</body>
</html>
