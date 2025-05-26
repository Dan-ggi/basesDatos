<?php
  //MANEJO DE SESIONES
  session_start();
  if(!isset($_SESSION['usuario'])){
     header("Location : login.php");
     exit;
  }
  //FIN MANEJO DE SESIONES
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Ubicación</title>
</head>
<body>
    <form action="insertar_ubicacion.php" method="POST">

        <label for="Direccion">Dirección:</label>
        <input type="text" id="Direccion" name="Direccion" required><br><br>

        <label for="Barrio">Barrio:</label>
        <input type="text" id="Barrio" name="Barrio" required><br><br>

        <label for="Ciudad">Ciudad:</label>
        <input type="text" id="Ciudad" name="Ciudad" required><br><br>

        <label for="Departamento">Departamento:</label>
        <input type="text" id="Departamento" name="Departamento" required><br><br>

        
        <input type="submit" value="Registrar Ubicación">
    </form>
    <form>
        <input type="button" value="Volver al panel de control" onclick="location.href='../panel_control.php'">
    </from>

    <?php
        include '../conexion_bd.php';
        $conn = conexion_bd();
        $sql_ubicacion = "SELECT * FROM Ubicacion";
        $resultados_ubicacion = mysqli_query($conn, $sql_ubicacion);
    ?>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Dirección</th>
                <th>Barrio</th>
                <th>Ciudad</th>
                <th>Departamento</th>
            </tr>
        </thead>
        <tbody>
            <?php while($fila = mysqli_fetch_assoc($resultados_ubicacion)): ?>
                <tr>
                    <td><?php echo $fila['ID_Ubicacion']; ?></td>
                    <td><?php echo $fila['Direccion']; ?></td>
                    <td><?php echo $fila['Barrio']; ?></td>
                    <td><?php echo $fila['Ciudad']; ?></td>
                    <td><?php echo $fila['Departamento']; ?></td>
                    <td><a href="eliminar_ubicacion.php?ID_Ubicacion=<?php echo $fila['ID_Ubicacion'];?>">eliminar  </href></td>
                    <td><a href="actualizar.php?ID_Ubicacion=<?php echo $fila['ID_Ubicacion'];?>">actualizar  </href></td>
                </tr>
            <?php endwhile; ?>  
        </tbody>
    </table>

    <a href="/empresa/login/loguot.php">Cerrar Sesión</a>

</body>
</html>
