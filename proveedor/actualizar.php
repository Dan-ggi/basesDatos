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

    $ID_Proveedor = $_GET['ID_Proveedor'];
    $sql="SELECT * FROM Proveedores WHERE ID_Proveedor = $ID_Proveedor";
    $resultado = mysqli_query($conn, $sql);
    $fila = mysqli_fetch_assoc($resultado);

    $ID_Proveedor = $fila['ID_Proveedor'];
    $Nombre = $fila['Nombre'];
    $Telefono = $fila['telefono'];
    $Email = $fila['email'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>actualizar proveedor</title>
</head>
<body>
    <form action="actualizar_proveedor.php" method="POST">
        <input type="hidden" name="ID_Proveedor" value="<?php echo $ID_Proveedor; ?>" hidden>

        <label for="Nombre">Nombre proveedor:</label>
        <input type="text" id="Nombre" name="Nombre" value="<?php echo $Nombre; ?>" required><br><br>

        <label for="Telefono">Teléfono:</label>
        <input type="text" id="Telefono" name="Telefono" value="<?php echo $Telefono; ?>" required><br><br>

        <label for="Email">Email:</label>
        <input type="email" id="Email" name="Email" value="<?php echo $Email; ?>" required><br><br>

        <input type="submit" value="actualizar proveedor">
    </form>
</body>
</html>
