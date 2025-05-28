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

    $ID_Cargo = $_GET['ID_Cargo'];
    $sql="SELECT * FROM Cargos WHERE ID_Cargo = $ID_Cargo";
    $resultado = mysqli_query($conn, $sql);
    $fila = mysqli_fetch_assoc($resultado);

    $ID_Cargo = $fila['ID_Cargo'];
    $Nombre_Cargo = $fila['Nombre_Cargo'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>actualizar cargo</title>
</head>
<body>
    <form action="actualizar_cargo.php" method="POST">
        <input type="hidden" name="ID_Cargo" value="<?php echo $ID_Cargo; ?>" hidden>

        <label for="Nombre_Cargo">Nombre cargo:</label>
        <input type="text" id="Nombre_Cargo" name="Nombre_Cargo" value="<?php echo $Nombre_Cargo; ?>" required><br><br>

        <input type="submit" value="actualizar cargo">
    </form>
</body>
</html>
