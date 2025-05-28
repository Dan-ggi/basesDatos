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
    <title>Formulario Venta</title>
</head>
<body>

    <form action="insertar_venta.php" method="POST">
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

        <label for="Metodo_Pago">Método de pago:</label><br>
        <select id="Metodo_Pago" name="ID_Metodo_Pago" required>
            <option value="">Seleccione el método de pago</option>
            <option value="1">Efectivo</option>
            <option value="2">Tarjeta Débito</option>
            <option value="3">Tarjeta Crédito</option>
        </select><br><br>


        <label for="Fecha">Fecha de venta:</label>
        <input type="date" id="Fecha" name="Fecha" required><br><br>

        <label for="Total_Venta">Total de la venta:</label><br>
        <input type="number" id="Total_Venta" name="Total_Venta" step="0.01" min="0" required><br><br>


        <input type="submit" value="Registrar Venta">
    </form>

    <form>
        <input type="button" value="Volver al panel de control" onclick="location.href='../panel_control.php'">
    </form>

    <br><br>

    <?php
        $sql_venta = "SELECT * FROM Ventas";
        $resultados_venta = mysqli_query($conn, $sql_venta);
    ?>

    <table border="1">
        <thead>
            <tr>
                <th>ID Venta</th>
                <th>ID Factura</th>
                <th>ID Método Pago</th>
                <th>ID Cliente</th>
                <th>ID Tienda</th>
                <th>Fecha de venta</th>
                <th>Total venta</th>

            </tr>
        </thead>
        <tbody>
            <?php while($fila = mysqli_fetch_assoc($resultados_venta)): ?>
                <tr>
                    <td><?php echo $fila['ID_Venta']; ?></td>
                    <td><?php echo $fila['ID_Factura']; ?></td>
                    <td><?php echo $fila['ID_Metodo_Pago']; ?></td>
                    <td><?php echo $fila['ID_Cliente']; ?></td>
                    <td><?php echo $fila['ID_Tienda']; ?></td>
                    <td><?php echo $fila['Fecha']; ?></td>
                    <td><?php echo $fila['Total_Venta']; ?></td>
                    <td>
                        <a href="eliminar_venta.php?ID_Venta=<?php echo $fila['ID_Venta']; ?>">Eliminar</a> |
                        <a href="actualizar.php?ID_Venta=<?php echo $fila['ID_Venta'];?>">Actualizar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <br>
    <a href="/empresa/login/loguot.php">Cerrar Sesión</a>

</body>
</html>
