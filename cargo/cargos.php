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
    <title>Formulario Cargos</title>
</head>
<body>
    <form action="insertar_cargos.php" method="POST">

        <label for="Nombre_Cargo">Nombre cargo:</label>
        <input type="text" id="Nombre_Cargo" name="Nombre_Cargo" required><br><br>
        
        <input type="submit" value="Registrar Cargo">
    </form>
    <form>
        <input type="button" value="Volver al panel de control" onclick="location.href='../panel_control.php'">
    </from>

    <?php
        include '../conexion_bd.php';
        $conn = conexion_bd();
        $sql_cargos = "SELECT * FROM Cargos";
        $resultados_cargos = mysqli_query($conn, $sql_cargos);
    ?>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Cargo</th>
            </tr>
        </thead>
        <tbody>
            <?php while($fila = mysqli_fetch_assoc($resultados_cargos)): ?>
                <tr>
                    <td><?php echo $fila['ID_Cargo']; ?></td>
                    <td><?php echo $fila['Nombre_Cargo']; ?></td>
                    <td><a href="eliminar_cargo.php?ID_Cargo=<?php echo $fila['ID_Cargo'];?>">eliminar  </href></td>
                    <td><a href="actualizar.php?ID_Cargo=<?php echo $fila['ID_Cargo'];?>">actualizar  </href></td>
                </tr>
            <?php endwhile; ?>  
        </tbody>
    </table>

    <a href="/empresa/login/loguot.php">Cerrar Sesión</a>

</body>
</html>
