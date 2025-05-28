<?php
  //MANEJO DE SESIONES
  session_start();
  if(!isset($_SESSION['usuario'])){
     header("Location : login.php");
     exit;
  }
  //FIN MANEJO DE SESIONES
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Panel de Control</title>
</head>
<body>
    <button onclick="location.href='cliente/clientes.php'">Clientes</button>    
    <button onclick="location.href='empleado/empleados.php'">Empleados</button>
    <button onclick="location.href='cargo/cargos.php'">Cargos</button>
    <button onclick="location.href='tienda/tiendas.php'">Tienda</button>
    <button onclick="location.href='ubicacion/ubicaciones.php'">Ubicación</button>
    <button onclick="location.href='compra_cliente/compras_clientes.php'">Compra cliente</button>
    <button onclick="location.href='producto/productos.php'">Productos</button>
    <button onclick="location.href='proveedor/proveedores.php'">Proveedor</button>
    <button onclick="location.href='promocion/promociones.php'">Promociones</button>
    <button onclick="location.href='inventario/inventarios.php'">Inventario</button>
    <button onclick="location.href='turno/turnos.php'">Turnos</button>
    <button onclick="location.href='venta/ventas.php'">Ventas</button>
    <button onclick="location.href='factura/facturas.php'">Facturas</button>
    <button onclick="location.href='reclamacion/reclamaciones.php'">Reclamaciones</button>
    

    <a href="/empresa/login/loguot.php">Cerrar Sesión</a>

</body>
</html>
