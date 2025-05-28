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
    <title>Formulario Producto</title>
</head>
<body>
    <form action="insertar_producto.php" method="POST">


        <label for="Nombre_Producto">Nombre Producto:</label>
        <input type="text" id="Nombre_Producto" name="Nombre_Producto" required><br><br>

        <label for="Categoria">Categoria:</label>
        <input type="text" id="Categoria" name="Categoria" required><br><br>

        <label for="Subcategoria">Subcategoria:</label>
        <input type="text" id="Subcategoria" name="Subcategoria" required><br><br>
    

        <input type="submit" value="Registrar Producto">
    </form>
    <form>
        <input type="button" value="Volver al panel de control" onclick="location.href='../panel_control.php'">
    </from>

    <?php
        include '../conexion_bd.php';
        $conn = conexion_bd();
        $sql_producto = "SELECT * FROM Productos";
        $resultados_producto = mysqli_query($conn, $sql_producto);
    ?>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre producto</th>
                <th>Categoria</th>
                <th>Subcategoria</th>
            </tr>
        </thead>
        <tbody>
            <?php while($fila = mysqli_fetch_assoc($resultados_producto)): ?>
                <tr>
                    <td><?php echo $fila['ID_Producto']; ?></td>
                    <td><?php echo $fila['Nombre_Producto']; ?></td>
                    <td><?php echo $fila['Categoria']; ?></td>
                    <td><?php echo $fila['Subcategoria']; ?></td>
                    <td><a href="eliminar_producto.php?ID_Producto=<?php echo $fila['ID_Producto'];?>">eliminar  </href></td>
                    <td><a href="actualizar.php?ID_Producto=<?php echo $fila['ID_Producto'];?>">actualizar  </href></td>
                </tr>
            <?php endwhile; ?>  
        </tbody>
    </table>

    <a href="/empresa/login/loguot.php">Cerrar Sesión</a>

</body>
</html>
