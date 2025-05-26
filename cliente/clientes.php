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
    <title>Formulario Cliente</title>
</head>
<body>
    <form action="insertar_clientes.php" method="POST">

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

        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="Fecha_Nacimiento" required><br><br>


    

        <input type="submit" value="Registrar Cliente">
    </form>
    <form>
        <input type="button" value="Volver al panel de control" onclick="location.href='../panel_control.php'">
    </from>

    <?php
        include '../conexion_bd.php';
        $conn = conexion_bd();
        $sql_clientes = "SELECT * FROM Clientes";
        $resultados_clientes = mysqli_query($conn, $sql_clientes);
    ?>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Documento</th>
                <th>Nombre</th>
                <th>Primer Apellido</th>
                <th>Segundo Apellido</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Fecha de Nacimiento</th>
            </tr>
        </thead>
        <tbody>
            <?php while($fila = mysqli_fetch_assoc($resultados_clientes)): ?>
                <tr>
                    <td><?php echo $fila['ID_Cliente']; ?></td>
                    <td><?php echo $fila['Documento']; ?></td>
                    <td><?php echo $fila['Nombre']; ?></td>
                    <td><?php echo $fila['Primer_Apellido']; ?></td>
                    <td><?php echo $fila['Segundo_Apellido']; ?></td>
                    <td><?php echo $fila['Telefono']; ?></td>
                    <td><?php echo $fila['Email']; ?></td>
                    <td><?php echo $fila['Fecha_Nacimiento']; ?></td>
                    <td><a href="eliminar_cliente.php?ID_Cliente=<?php echo $fila['ID_Cliente'];?>">eliminar  </href></td>
                    <td><a href="actualizar.php?ID_Cliente=<?php echo $fila['ID_Cliente'];?>">actualizar  </href></td>
                </tr>
            <?php endwhile; ?>  
        </tbody>
    </table>

    <a href="/empresa/login/loguot.php">Cerrar Sesión</a>

</body>
</html>
