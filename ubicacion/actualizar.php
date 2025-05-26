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

    $ID_Ubicacion = $_GET['ID_Ubicacion'];
    $sql="SELECT * FROM Ubicacion WHERE ID_ubicacion = $ID_Ubicacion";
    $resultado = mysqli_query($conn, $sql);
    $fila = mysqli_fetch_assoc($resultado);

    $ID_Ubicacion = $fila['ID_Ubicacion'];
    $Direccion = $fila['Direccion'];
    $Ciudad = $fila['Ciudad'];
    $Barrio = $fila['Barrio'];
    $Departamento = $fila['Departamento'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>actualizar ubicación</title>
</head>
<body>
    <form action="actualizar_ubicacion.php" method="POST">
        <input type="hidden" name="ID_Ubicacion" value="<?php echo $ID_Ubicacion; ?>" hidden>
        <label for="Direccion">Dirección:</label>
        <input type="text" id="Direccion" name="Direccion" value="<?php echo $Direccion; ?>" required><br><br>

        <label for="Ciudad">Ciudad:</label>
        <input type="text" id="Ciudad" name="Ciudad" value="<?php echo $Ciudad; ?>" required><br><br>

        <label for="Barrio">Barrio:</label>
        <input type="text" id="Barrio" name="Barrio" value="<?php echo $Barrio; ?>" required><br><br>

        <label for="Departamento">Departamento:</label>
        <input type="text" id="Departamento" name="Departamento" value="<?php echo $Departamento; ?>" required><br><br>


        <input type="submit" value="actualizar ubicación">
    </form>
</body>
</html>
