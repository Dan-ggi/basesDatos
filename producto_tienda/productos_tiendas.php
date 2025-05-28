<?php
  // MANEJO DE SESIONES
  session_start();
  if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
  }
  // FIN MANEJO DE SESIONES
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario Producto Tienda</title>
</head>
<body>
  <?php
    include '../conexion_bd.php';
    $conn = conexion_bd();
  ?>

  <form action="insertar_prodcuto_tienda.php" method="POST">

    <!-- SELECT TIENDA -->
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

    <!-- SELECT CLIENTE -->
    <label for="cliente_id">Cliente:</label><br>
    <select id="cliente_id" name="ID_Cliente" required>
      <option value="">Seleccione el cliente</option>  
      <?php
        $sql_cliente = "SELECT ID_Cliente, Nombre, Primer_Apellido, Documento FROM Clientes ORDER BY Nombre ASC";
        $resultado_cliente = mysqli_query($conn, $sql_cliente);
        while ($fila = mysqli_fetch_assoc($resultado_cliente)) {
          echo "<option value='" . $fila['ID_Cliente'] . "'>" 
            . $fila['Nombre'] . " " 
            . $fila['Primer_Apellido'] . " - Doc: " 
            . $fila['Documento'] . 
            "</option>";
        }
      ?>
    </select><br><br>   

    <!-- SELECT PRODUCTO -->
    <label for="producto_id">Producto:</label><br>
    <select id="producto_id" name="ID_Producto" required>
      <option value="">Seleccione el producto</option>
      <?php
        $sql_producto = "SELECT ID_Producto, Nombre_Producto FROM Productos ORDER BY Nombre_Producto ASC";
        $resultado_producto = mysqli_query($conn, $sql_producto);
        while ($fila = mysqli_fetch_assoc($resultado_producto)) {
          echo "<option value='" . $fila['ID_Producto'] . "'>" 
            . $fila['Nombre_Producto'] . "</option>";
        }
      ?>
    </select><br><br>

    <input type="submit" value="Registrar producto tienda">
  </form>

  <form>
    <input type="button" value="Volver al panel de control" onclick="location.href='../panel_control.php'">
  </form>

  <?php
    $sql_producto_tienda = "SELECT * FROM Producto_Tienda"; 
    $resultados_producto_tienda = mysqli_query($conn, $sql_producto_tienda);
  ?>

  <table border="1">
    <thead>
      <tr>
        <th>ID Producto tienda</th>
        <th>ID Producto</th>
        <th>ID tienda</th>
      </tr>
    </thead>
    <tbody>
      <?php while($fila = mysqli_fetch_assoc($resultados_producto_tienda)): ?>
        <tr>
          <td><?php echo $fila['id_producto_tienda']; ?></td>
          <td><?php echo $fila['id_producto']; ?></td>
          <td><?php echo $fila['id_tienda']; ?></td>
          <td>
            <a href="eliminar_producto_tienda.php?id_producto_tienda=<?php echo isset($fila['id_producto_tienda']) ? $fila['id_producto_tienda'] : '0'; ?>">eliminar</a> |
            <a href="actualizar.php?id_producto_tienda=<?php echo isset($fila['id_producto_tienda']) ? $fila['id_producto_tienda'] : '0'; ?>">actualizar</a>
          </td>
        </tr>
      <?php endwhile; ?>  
    </tbody>
  </table>

  <a href="/empresa/login/loguot.php">Cerrar Sesión</a>

</body>
</html>
