<?php
  //MANEJO DE SESIONES
  session_start();
  if(!isset($_SESSION['usuario'])){
     header("Location : login.php");
     exit;
  }
  //FIN MANEJO DE SESIONES
?>
<?php
    include '../conexion_bd.php';
    $conn = conexion_bd();

    $ID_Inventario = $_GET['ID_Inventario'];
    $sql="SELECT * FROM Inventario WHERE ID_Inventario = $ID_Inventario";
    $resultado = mysqli_query($conn, $sql);
    $fila = mysqli_fetch_assoc($resultado);

    $ID_Producto = $fila['ID_Producto'];
    $Cantidad_Disponible = $fila['Cantidad_Disponible'];
    $Fecha_Reposicion = $fila['Fecha_Reposicion'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>actualizar datos de inventario</title>
</head>
<body>
    <form action="actualizar_inventario.php" method="POST">
        <input type="hidden" name="ID_Inventario" value="<?php echo $ID_Inventario; ?>" hidden>

        <label for="cantidad_disponible">Cantidad Disponible:</label>
        <input type="number" id="cantidad_disponible" name="Cantidad_Disponible" value="<?php echo $Cantidad_Disponible; ?>" required><br><br>

        <label for="fecha_reposicion">Fecha de Reposición:</label>
        <input type="date" id="fecha_reposicion" name="Fecha_Reposicion" value="<?php echo $Fecha_Reposicion; ?>" required><br><br>

        <label for="producto_id">Productos:</label><br>
        <select id="producto_id" name="ID_Producto" required>
            <option value="">Seleccione Producto</option>
            <?php
                $sql_producto = "SELECT ID_Producto, Nombre_Producto FROM Productos ORDER BY Nombre_Producto ASC";
                $resultado_producto = mysqli_query($conn, $sql_producto);
                while ($fila = mysqli_fetch_assoc($resultado_producto)) {
                    echo "<option value='" . $fila['ID_Producto'] . "'>" 
                        . $fila['Nombre_Producto'] . " - ID: " 
                        . $fila['ID_Producto'] . 
                        "</option>";
                }
            ?>
        </select><br><br>

        <input type="submit" value="actualizar Inventario">
    </form>
</body>
</html>
