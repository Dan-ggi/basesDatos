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

    $ID_Promo = $_GET['ID_Promo'];
    $sql="SELECT * FROM Promociones WHERE ID_Promo = $ID_Promo";
    $resultado = mysqli_query($conn, $sql);
    $fila = mysqli_fetch_assoc($resultado);

    $Descripcion = $fila['Descripcion'];
    $Fecha_Inicio = $fila['Fecha_Inicio'];
    $Fecha_Fin = $fila['Fecha_Fin'];
    $estado = $fila['estado'];
    $Cantidad = $fila['Cantidad'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>actualizar Promociones</title>
</head>
<body>
    <form action="actualizar_promo.php" method="POST">
        <input type="hidden" name="ID_Promo" value="<?php echo $ID_Promo; ?>" hidden>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="Nombre" value="<?php echo $fila['Nombre']; ?>" required><br><br>

        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="Descripcion" value="<?php echo $Descripcion; ?>" required><br><br>

        <label for="fecha_inicio">Fecha de Inicio:</label>
        <input type="date" id="fecha_inicio" name="Fecha_Inicio" value="<?php echo $Fecha_Inicio; ?>" required><br><br>

        <label for="fecha_fin">Fecha de Fin:</label>
        <input type="date" id="fecha_fin" name="Fecha_Fin" value="<?php echo $Fecha_Fin; ?>" required><br><br>

        <label for="estado">Estado:</label>
        <select id="estado" name="Estado" required>
            <option value="Activo" <?php if($estado == 'Activo') echo 'selected'; ?>>Activo</option>
            <option value="Inactivo" <?php if($estado == 'Inactivo') echo 'selected'; ?>>Inactivo</option> 
        </select><br><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="Cantidad" value="<?php echo $Cantidad; ?>" required><br><br>


        <input type="submit" value="actualizar Cliente">
    </form>
</body>
