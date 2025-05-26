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
    <title>Formulario Proveedor</title>
</head>
<body>
    <form action="insertar_proveedores.php" method="POST">

        <label for="Nombre">Nombre proveedor:</label>
        <input type="text" id="Nombre" name="Nombre" required><br><br>

        <label for="Telefono">Teléfono:</label>
        <input type="text" id="Telefono" name="Telefono" required><br><br>

        <label for="Email">Email:</label>
        <input type="email" id="Email" name="Email" required><br><br>
        
        <input type="submit" value="Registrar Proveedor">
    </form>
    <form>
        <input type="button" value="Volver al panel de control" onclick="location.href='../panel_control.php'">
    </from>

    <?php
        include '../conexion_bd.php';
        $conn = conexion_bd();
        $sql_proveedor = "SELECT * FROM Proveedores";
        $resultados_proveedor = mysqli_query($conn, $sql_proveedor);
    ?>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Proveedor</th>
                <th>Teléfono</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php while($fila = mysqli_fetch_assoc($resultados_proveedor)): ?>
                <tr>
                    <td><?php echo $fila['ID_Proveedor']; ?></td>
                    <td><?php echo $fila['Nombre']; ?></td>
                    <td><?php echo $fila['telefono']; ?></td>
                    <td><?php echo $fila['email']; ?></td>
                    <td><a href="eliminar_proveedor.php?ID_Proveedor=<?php echo $fila['ID_Proveedor'];?>">eliminar  </href></td>
                    <td><a href="actualizar.php?ID_Proveedor=<?php echo $fila['ID_Proveedor'];?>">actualizar  </href></td>
                </tr>
            <?php endwhile; ?>  
        </tbody>
    </table>

    <a href="/empresa/login/loguot.php">Cerrar Sesión</a>

</body>
</html>
