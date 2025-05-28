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

    $id = $_GET['id'];
    $sql="SELECT * FROM Productos_Afectados WHERE id = $id";
    $resultado = mysqli_query($conn, $sql);
    $fila = mysqli_fetch_assoc($resultado);


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>actualizar producto afectado</title>
</head>
<body>
    <form action="actualizar_cargo.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>" hidden>

        

        <input type="submit" value="actualizar cargo">
    </form>
</body>
</html>
