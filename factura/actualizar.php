<?php
  //MANEJO DE SESIONES
  session_start();
  if(!isset($_SESSION['usuario'])){
     header("Location: login.php");
     exit;
  }
  //FIN MANEJO DE SESIONES
?>
<?php
    include '../conexion_bd.php';
    $conn = conexion_bd();

    $ID_Factura = $_GET['ID_Factura'];
    $sql="SELECT * FROM Facturas WHERE ID_Factura = $ID_Factura";
    $resultado = mysqli_query($conn, $sql);
    $fila = mysqli_fetch_assoc($resultado);

    $ID_Cliente = $fila['ID_Cliente'];
    $Fecha = $fila['Fecha'];
    $Monto_Total = $fila['Monto_Total'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>actualizar factura</title>
</head>
<body>
    <form action="actualizar_factura.php" method="POST">
        <input type="hidden" name="ID_Factura" value="<?php echo $ID_Factura; ?>" hidden>

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
        <input type="date" id="Fecha" name="Fecha" value="<?php echo $Monto_Total; ?>" required><br><br>

        <label for="Monto_Total">Monto Total:</label><br>
        <input type="number" id="Monto_Total" name="Monto_Total" value="<?php echo $Monto_Total; ?>" required><br><br>


        <input type="submit" value="actualizar factura">
    </form>
</body>
</html>
