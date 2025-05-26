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

    $ID_Cliente = $_GET['ID_Cliente'];
    $sql="SELECT * FROM Clientes WHERE ID_Cliente = $ID_Cliente";
    $resultado = mysqli_query($conn, $sql);
    $fila = mysqli_fetch_assoc($resultado);

    $Documento = $fila['Documento'];
    $Nombre = $fila['Nombre'];
    $Primer_Apellido = $fila['Primer_Apellido'];
    $Segundo_Apellido = $fila['Segundo_Apellido'];
    $Telefono = $fila['Telefono'];
    $Email = $fila['Email'];
    $Fecha_Nacimiento = $fila['Fecha_Nacimiento'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>actualizar datos del cliente</title>
</head>
<body>
    <form action="actualizar_cliente.php" method="POST">
        <input type="hidden" name="ID_Cliente" value="<?php echo $ID_Cliente; ?>" hidden>

        <label for="documento">Documento:</label>
        <input type="text" id="documento" name="Documento" value="<?php echo $Documento; ?>" required><br><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="Nombre" value="<?php echo $Nombre; ?>" required><br><br>

        <label for="primer_apellido">Primer apellido:</label>
        <input type="text" id="primer_apellido" name="Primer_Apellido" value="<?php echo $Primer_Apellido; ?>" required><br><br>

        <label for="segundo_apellido">Segundo apellido:</label>
        <input type="text" id="segundo_apellido" name="Segundo_Apellido" value="<?php echo $Segundo_Apellido; ?>" required><br><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="Telefono" value="<?php echo $Telefono; ?>" required><br><br>

        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="Email" value="<?php echo $Email; ?>" required><br><br>

        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="Fecha_Nacimiento" value="<?php echo $Fecha_Nacimiento; ?>" required><br><br>

        <input type="submit" value="actualizar Cliente">
    </form>
</body>
</html>
