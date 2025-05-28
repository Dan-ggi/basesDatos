<?php
  include '../conexion_bd.php';
  $conn = conexion_bd();

  // Validación de campos obligatorios
  if (!isset($_POST['ID_Producto']) || !isset($_POST['ID_Tienda'])) {
    die("Error: datos incompletos.");
  }

  $id_producto = intval($_POST['ID_Producto']);
  $id_tienda = intval($_POST['ID_Tienda']);

  $sql = "INSERT INTO Producto_Tienda (
      ID_Producto, 
      ID_Tienda
  ) VALUES (
      $id_producto, 
      $id_tienda
  )";

  if (mysqli_query($conn, $sql)) {
    echo "Producto en la tienda registrado correctamente.";
  } else {
    echo "Error al registrar el producto en la tienda: " . mysqli_error($conn);
  }

  mysqli_close($conn);
  header("Location: productos_tiendas.php");
  exit;
?>
