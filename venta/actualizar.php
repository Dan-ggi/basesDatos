<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

include '../conexion_bd.php';
$conn = conexion_bd();

if (!isset($_GET['ID_Venta'])) {
    echo "ID de venta no proporcionado.";
    exit;
}

$id_venta = intval($_GET['ID_Venta']);

$sql = "SELECT * FROM Ventas WHERE ID_Venta = $id_venta";
$resultado = mysqli_query($conn, $sql);
$venta = mysqli_fetch_assoc($resultado);

if (!$venta) {
    echo "Venta no encontrada.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Venta</title>
</head>
<body>
    <h2>Actualizar Venta</h2>
    <form action="actualizar_venta.php" method="POST">
        <input type="hidden" name="ID_Venta" value="<?php echo $venta['ID_Venta']; ?>">

        <label for="ID_Tienda">Tienda:</label>
        <select name="ID_Tienda" required>
            <?php
                $tiendas = mysqli_query($conn, "SELECT ID_Tienda, Nombre_Tienda FROM Tiendas ORDER BY Nombre_Tienda ASC");
                while ($t = mysqli_fetch_assoc($tiendas)) {
                    $selected = ($t['ID_Tienda'] == $venta['ID_Tienda']) ? "selected" : "";
                    echo "<option value='{$t['ID_Tienda']}' $selected>{$t['Nombre_Tienda']}</option>";
                }
            ?>
        </select><br><br>

        <label for="ID_Cliente">Cliente:</label>
        <select name="ID_Cliente" required>
            <?php
                $clientes = mysqli_query($conn, "SELECT ID_Cliente, Nombre, Primer_Apellido FROM Clientes ORDER BY Nombre ASC");
                while ($c = mysqli_fetch_assoc($clientes)) {
                    $selected = ($c['ID_Cliente'] == $venta['ID_Cliente']) ? "selected" : "";
                    echo "<option value='{$c['ID_Cliente']}' $selected>{$c['Nombre']} {$c['Primer_Apellido']}</option>";
                }
            ?>
        </select><br><br>

        <label for="ID_Metodo_Pago">Método de pago:</label>
        <select name="ID_Metodo_Pago" required>
            <option value="1" <?php if ($venta['ID_Metodo_Pago'] == 1) echo "selected"; ?>>Efectivo</option>
            <option value="2" <?php if ($venta['ID_Metodo_Pago'] == 2) echo "selected"; ?>>Tarjeta Débito</option>
            <option value="3" <?php if ($venta['ID_Metodo_Pago'] == 3) echo "selected"; ?>>Tarjeta Crédito</option>
        </select><br><br>

        <label for="Fecha">Fecha:</label>
        <input type="date" name="Fecha" value="<?php echo $venta['Fecha']; ?>" required><br><br>

        <label for="Total_Venta">Total Venta:</label>
        <input type="number" name="Total_Venta" value="<?php echo $venta['Total_Venta']; ?>" step="0.01" min="0" required><br><br>

        <input type="submit" value="Actualizar">
    </form>
    <br>
    <a href="ventas.php">Cancelar</a>
</body>
</html>
