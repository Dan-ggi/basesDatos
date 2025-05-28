<?php
  // MANEJO DE SESIONES
  session_start();
  if(!isset($_SESSION['usuario'])){
     header("Location: login.php");
     exit;
  }

  include '../conexion_bd.php';
  $conn = conexion_bd();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Cliente</title>
</head>
<body>
    <form action="insertar_factura.php" method="POST">
        <label for="Clientes">Cliente:</label><br>
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

        <label for="Fecha">Fecha de la factura:</label>
        <input type="date" id="Fecha" name="Fecha" required><br><br>

        <label for="Monto_Total">Monto Total:</label><br>
        <input type="number" id="Monto_Total" name="Monto_Total" required><br><br>

        <input type="submit" value="Registrar Factura">
    </form>

    <form>
        <input type="button" value="Volver al panel de control" onclick="location.href='../panel_control.php'">
    </form>

    <?php
        $sql_factura = "SELECT * FROM Facturas";
        $resultados_factura = mysqli_query($conn, $sql_factura);
    ?>

    <table border="1">
        <thead>
            <tr>
                <th>ID Factura</th>
                <th>ID Cliente</th>
                <th>Fecha factura</th>
                <th>Monto total</th>
            </tr>
        </thead>
        <tbody>
            <?php while($fila = mysqli_fetch_assoc($resultados_factura)): ?>
                <tr>
                    <td><?php echo $fila['ID_Factura']; ?></td>
                    <td><?php echo $fila['ID_Cliente']; ?></td>
                    <td><?php echo $fila['Fecha']; ?></td>
                    <td><?php echo $fila['Monto_Total']; ?></td>
                    <td>
                        <a href="eliminar_factura.php?ID_Factura=<?php echo $fila['ID_Factura'];?>">Eliminar</a> |
                        <a href="actualizar.php?ID_Factura=<?php echo $fila['ID_Factura'];?>">Actualizar</a>
                    </td>
                </tr>
            <?php endwhile; ?>  
        </tbody>
    </table>

    <br>
    <a href="/empresa/login/loguot.php">Cerrar Sesión</a>
</body>
</html>
