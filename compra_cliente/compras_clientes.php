<?php
  // MANEJO DE SESIONES
  session_start();
  if(!isset($_SESSION['usuario'])){
     header("Location: login.php");
     exit;
  }

  // CONEXIÓN A BD Y CONSULTAS
  include '../conexion_bd.php';
  $conn = conexion_bd();

  // Consulta para obtener clientes
  $sql_clientes = "SELECT ID_Cliente, Documento, Nombre, Primer_Apellido FROM Clientes";
  $resultado_clientes = mysqli_query($conn, $sql_clientes);

  // Consulta para obtener facturas
  $sql_facturas = "SELECT f.ID_Factura, f.ID_Cliente, c.Nombre, c.Primer_Apellido, c.Documento
                   FROM Facturas f
                   JOIN Clientes c ON f.ID_Cliente = c.ID_Cliente";
  $resultado_facturas = mysqli_query($conn, $sql_facturas);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Compra</title>
</head>
<body>
    <form action="insertar_compra.php" method="POST">

        <label for="ID_Cliente">Seleccionar cliente:</label><br>
        <select name="ID_Cliente" id="ID_Cliente" required>
            <option value="">Seleccione un cliente</option>
            <?php while($cliente = mysqli_fetch_assoc($resultado_clientes)): ?>
                <option value="<?php echo $cliente['ID_Cliente']; ?>">
                    Cliente #<?php echo $cliente['ID_Cliente']; ?> - <?php echo $cliente['Nombre'] . " " . $cliente['Primer_Apellido']; ?> - Doc: <?php echo $cliente['Documento']; ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>
        
        <label for="ID_Factura">Seleccionar factura:</label><br>
        <select name="ID_Factura" id="ID_Factura" required>
            <option value="">Seleccione una factura</option>
            <?php while($factura = mysqli_fetch_assoc($resultado_facturas)): ?>
                <option value="<?php echo $factura['ID_Factura']; ?>">
                    Factura #<?php echo $factura['ID_Factura']; ?> - Cliente #<?php echo $factura['ID_Cliente']; ?> - <?php echo $factura['Nombre'] . " " . $factura['Primer_Apellido']; ?> - Doc: <?php echo $factura['Documento']; ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label for="Cantidad_compras">Cantidad de compras:</label>
        <input type="number" id="Cantidad_compras" name="Cantidad_compras" required><br><br>

        <label for="Fecha">Fecha:</label>
        <input type="date" id="Fecha" name="Fecha" required><br><br>

        <input type="submit" value="Registrar Compra">
    </form>
    <form>
        <input type="button" value="Volver al panel de control" onclick="location.href='../panel_control.php'">
    </form>

    <?php
        $sql_compra = "SELECT * FROM Compras_Clientes";
        $resultados_compra = mysqli_query($conn, $sql_compra);
    ?>

    <table border="1">
        <thead>
            <tr>
                <th>ID Compra</th>
                <th>ID Cliente</th>
                <th>ID Factura</th>
                <th>Cantidad compras</th>
            </tr>
        </thead>
        <tbody>
            <?php while($fila = mysqli_fetch_assoc($resultados_compra)): ?>
                <tr>
                    <td><?php echo $fila['ID_Compra']; ?></td>
                    <td><?php echo $fila['ID_Cliente']; ?></td>
                    <td><?php echo $fila['ID_Factura']; ?></td>
                    <td><?php echo $fila['Cantidad_compras']; ?></td>
                    <td><a href="eliminar_compra.php?ID_Compra=<?php echo $fila['ID_Compra'];?>">eliminar</a></td>
                    <td><a href="actualizar.php?ID_Compra=<?php echo $fila['ID_Compra'];?>">actualizar</a></td>
                </tr>
            <?php endwhile; ?>  
        </tbody>
    </table>

    <a href="/empresa/login/loguot.php">Cerrar Sesión</a>

</body>
</html>
