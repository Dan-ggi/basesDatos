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

    $ID_Empleado = $_GET['ID_Empleado'];
    $sql="SELECT * FROM Empleados WHERE ID_Empleado = $ID_Empleado";
    $resultado = mysqli_query($conn, $sql);
    $fila = mysqli_fetch_assoc($resultado);

    $Documento = $fila['Documento'];
    $ID_Tienda = $fila['ID_Tienda'];
    $ID_Cargo = $fila['ID_Cargo'];
    $Nombre = $fila['Nombre'];
    $Primer_Apellido = $fila['Primer_Apellido'];
    $Segundo_Apellido = $fila['Segundo_Apellido'];
    $Telefono = $fila['Telefono'];
    $Email = $fila['Email'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>actualizar datos del empleado</title>
</head>
<body>
    <form action="actualizar_empleado.php" method="POST">
        <input type="hidden" name="ID_Empleado" value="<?php echo $ID_Empleado; ?>" hidden>

        <label for="documento">Documento:</label>
        <input type="text" id="documento" name="Documento" value="<?php echo $Documento; ?>" required><br><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="Nombre" value="<?php echo $Nombre; ?>" required><br><br>

        <label for="primer_apellido">Primer apellido:</label>
        <input type="text" id="primer_apellido" name="Primer_Apellido" value="<?php echo $Primer_Apellido; ?>" required><br><br>

        <label for="segundo_apellido">Segundo apellido:</label>
        <input type="text" id="segundo_apellido" name="Segundo_Apellido" value="<?php echo $Segundo_Apellido; ?>" required><br><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="Telefono" value="<?php echo $Telefono; ?>" required><br><br>

        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="Email" value="<?php echo $Email; ?>" required><br><br>

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

        <input type="submit" value="actualizar empleado">
    </form>
</body>
</html>
