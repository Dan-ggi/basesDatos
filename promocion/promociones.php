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
    <title>Formulario promociones</title>
</head>
<body>
    <form action="insertar_promo.php" method="POST">

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="Nombre" required><br><br>

        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="Descripcion" required><br><br>

        <label for="fecha_inicio">Fecha de inicio:</label>
        <input type="date" id="fecha_inicio" name="Fecha_Inicio" required><br><br>

        <label for="fecha_fin">Fecha de fin:</label>
        <input type="date" id="fecha_fin" name="Fecha_Fin" required><br><br>

        
        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option> 
        </select><br><br>


        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="Cantidad" required><br><br>


        <input type="submit" value="Registrar Promoción">
    </form>
    <form>
        <input type="button" value="Volver al panel de control" onclick="location.href='../panel_control.php'">
    </from>

    <?php
        include '../conexion_bd.php';
        $conn = conexion_bd();
        $sql_promo = "SELECT * FROM Promociones";
        $resultados_promo = mysqli_query($conn, $sql_promo);
    ?>

    <table border="1">
        <thead>
            <tr>
                <th>ID promo</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha inicio</th>
                <th>Fecha fin</th>
                <th>Estado</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <?php while($fila = mysqli_fetch_assoc($resultados_promo)): ?>
                <tr>
                    <td><?php echo $fila['ID_Promo']; ?></td>
                    <td><?php echo $fila['Nombre']; ?></td>
                    <td><?php echo $fila['Descripcion']; ?></td>
                    <td><?php echo $fila['Fecha_Inicio']; ?></td>
                    <td><?php echo $fila['Fecha_Fin']; ?></td>
                    <td><?php echo $fila['estado']; ?></td>
                    <td><?php echo $fila['Cantidad']; ?></td>
                    <td><a href="eliminar_promo.php?ID_Promo=<?php echo $fila['ID_Promo'];?>">eliminar  </href></td>
                    <td><a href="actualizar.php?ID_Promo=<?php echo $fila['ID_Promo'];?>">actualizar  </href></td>
                </tr>
            <?php endwhile; ?>  
        </tbody>
    </table>

    <a href="/empresa/login/loguot.php">Cerrar Sesión</a>

</body>
</html>
