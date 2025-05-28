<?php
// MANEJO DE SESIONES
session_start();
if(!isset($_SESSION['usuario'])){
   header("Location: login.php");
   exit;
}
// FIN MANEJO DE SESIONES

include '../conexion_bd.php';
$conn = conexion_bd();

$ID_Compra = isset($_GET['ID_Compra']) ? intval($_GET['ID_Compra']) : 0;

$sql = "SELECT * FROM Compras_Clientes WHERE ID_Compra = $ID_Compra";
$resultado = mysqli_query($conn, $sql);
$fila = mysqli_fetch_assoc($resultado);

if (!$fila) {
    echo "No se encontró la compra con ID $ID_Compra";
    exit;
}

$ID_Cliente = $fila['ID_Cliente'];
$ID_Factura = $fila['ID_Factura'];
$Cantidad_compras = $fila['Cantidad_compras'];

// Consultar clientes
$sql_clientes = "SELECT ID_Cliente, Nombre, Primer_Apellido, Documento FROM Clientes";
$resultado_clientes = mysqli_query($conn, $sql_clientes);

// Consultar facturas con join para datos del cliente
$sql_facturas = "SELECT f.ID_Factura, f.ID_Cliente, c.Nombre, c.Primer_Apellido, c.Documento 
                 FROM Facturas f 
                 JOIN Clientes c ON f.ID_Cliente = c.ID_Cliente";
$resultado_facturas = mysqli_query($conn, $sql_facturas);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar datos de la compra</title>
</head>
<body>

<form action="actualizar_compra.php" method="POST">
    <input type="hidden" name="ID_Compra" value="<?php echo $ID_Compra; ?>">

    <label for="ID_Cliente">Seleccionar cliente:</label><br>
    <select name="ID_Cliente" id="ID_Cliente" required>
        <option value="">Seleccione un cliente</option>
        <?php while($cliente = mysqli_fetch_assoc($resultado_clientes)): ?>
            <option value="<?php echo $cliente['ID_Cliente']; ?>" 
                <?php if ($cliente['ID_Cliente'] == $ID_Cliente) echo "selected"; ?>>
                Cliente #<?php echo $cliente['ID_Cliente']; ?> - <?php echo $cliente['Nombre'] . " " . $cliente['Primer_Apellido']; ?> - Doc: <?php echo $cliente['Documento']; ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>
    
    <label for="ID_Factura">Seleccionar factura:</label><br>
    <select name="ID_Factura" id="ID_Factura" required>
        <option value="">Seleccione una factura</option>
        <?php while($factura = mysqli_fetch_assoc($resultado_facturas)): ?>
            <option value="<?php echo $factura['ID_Factura']; ?>" 
                <?php if ($factura['ID_Factura'] == $ID_Factura) echo "selected"; ?>>
                Factura #<?php echo $factura['ID_Factura']; ?> - Cliente #<?php echo $factura['ID_Cliente']; ?> - <?php echo $factura['Nombre'] . " " . $factura['Primer_Apellido']; ?> - Doc: <?php echo $factura['Documento']; ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <label for="Cantidad_compras">Cantidad de compras:</label>
    <input type="number" id="Cantidad_compras" name="Cantidad_compras" required 
        value="<?php echo htmlspecialchars($Cantidad_compras); ?>"><br><br>

    <input type="submit" value="Actualizar Compra">
</form>

</body>
</html>
