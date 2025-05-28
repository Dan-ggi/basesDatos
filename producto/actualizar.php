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

    $ID_Producto = $_GET['ID_Producto'];
    $sql="SELECT * FROM Productos WHERE ID_Producto = $ID_Producto";
    $resultado = mysqli_query($conn, $sql);
    $fila = mysqli_fetch_assoc($resultado);

    $Nombre_Producto = $fila['Nombre_Producto'];
    $Categoria = $fila['Categoria'];
    $Subcategoria = $fila['Subcategoria'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>actualizar datos del producto</title>
</head>
<body>
    <form action="actualizar_producto.php" method="POST">
        <input type="hidden" name="ID_Producto" value="<?php echo $ID_Producto; ?>" hidden>

        <label for="Nombre_Producto">Nombre Producto:</label>
        <input type="text" id="Nombre_Producto" name="Nombre_Producto" value="<?php echo $Nombre_Producto; ?>" required><br><br>

        <label for="Categoria">Categoria:</label>
        <input type="text" id="Categoria" name="Categoria" value="<?php echo $Categoria; ?>" required><br><br>

        <label for="Subcategoria">Subcategoria:</label>
        <input type="text" id="Subcategoria" name="Subcategoria" value="<?php echo $Subcategoria; ?>" required><br><br>

      
        <input type="submit" value="actualizar Producto">
    </form>
</body>
</html>
