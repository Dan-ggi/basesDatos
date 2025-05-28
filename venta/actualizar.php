<?php
// MANEJO DE SESIONES
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

include '../conexion_bd.php';
$conn = conexion_bd();

$ID_Venta = $_GET['ID_Venta'];
$sql = "SELECT * FROM Ventas WHERE ID_Venta = $ID_Venta";
$resultado = mysqli_query($conn, $sql);
$fila = mysqli_fetch_assoc($resultado);

// Variables para cargar en el formulario
$ID_Factura = $fila['ID_Factura'];
$ID_Tienda = $fila['ID_Tienda'];
$ID_Cliente = $fila['ID_Cliente'];
$ID_Metodo_Pago = $fila['ID_Metodo_Pago'];
$Fecha = $fila['Fecha'];
$Total_Venta = $fila['Total_Venta'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Venta</title>
</head>
<body>

<h1>Actualizar Venta</h1>

<form action="actualizar_venta.php" method="POST">
    <input type="hidden" name="ID_Venta" value="<?php echo $ID_Venta; ?>">

    <!-- Tiendas -->
    <label for="tienda_id">Tienda:</label><br>
    <select id="tienda_id" name="ID_Tienda" required>
        <option value="">Seleccione la tienda</option>
        <?php
        $sql_tiendas = "SELECT ID_Tienda, Nombre_Tienda FROM Tiendas ORDER BY Nombre_Tienda ASC";
        $resultado_tiendas = mysqli_query($conn, $sql_tiendas);
        while ($tienda = mysqli_fetch_assoc($resultado_tiendas)) {
            $selected = ($tienda['ID_Tienda'] == $ID_Tienda) ? "selected" : "";
            echo "<option value='{$tienda['ID_Tienda']}' $selected>{$tienda['Nombre_Tienda']}</option>";
        }
        ?>
    </select><br><br>

    <!-- Clientes -->
    <label for="cliente_id">Cliente:</label><br>
    <select id="cliente_id" name="ID_Cliente" required>
        <option value="">Seleccione el cliente</option>
        <?php
        $sql_cliente = "SELECT ID_Cliente, Nombre, Primer_Apellido, Documento FROM Clientes ORDER BY Nombre ASC";
        $resultado_cliente = mysqli_query($conn, $sql_cliente);
        while ($cliente = mysqli_fetch_assoc($resultado_cliente)) {
            $selected = ($cliente['ID_Cliente'] == $ID_Cliente) ? "selected" : "";
            echo "<option value='{$cliente['ID_Cliente']}' $selected>{$cliente['Nombre']} {$cliente['Primer_Apellido']} - Doc: {$cliente['Documento']}</option>";
        }
        ?>
    </select><br><br>

    <!-- Métodos de pago -->
    <label for="Metodo_Pago">Método de pago:</label><br>
    <select id="Metodo_Pago" name="ID_Metodo_Pago" required>
        <option value="">Seleccione el método de pago</option>
        <?php
        $sql_metodos = "SELECT ID_Metodo_Pago, Nombre FROM Metodo_Pago ORDER BY Nombre ASC";
        $resultado_metodos = mysqli_query($conn, $sql_metodos);
        while ($metodo = mysqli_fetch_assoc($resultado_metodos)) {
            $selected = ($metodo['ID_Metodo_Pago'] == $ID_Metodo_Pago) ? "selected" : "";
            echo "<option value='{$metodo['ID_Metodo_Pago']}' $selected>{$metodo['Nombre']}</option>";
        }
        ?>
    </select><br><br>


    <!-- Fecha -->
    <label for="Fecha">Fecha de venta:</label><br>
    <input type="date" id="Fecha" name="Fecha" value="<?php echo $Fecha; ?>" required><br><br>

    <!-- Total -->
    <label for="Total_Venta">Total de la venta:</label><br>
    <input type="number" id="Total_Venta" name="Total_Venta" value="<?php echo $Total_Venta; ?>" step="0.01" min="0" required><br><br>

    <input type="submit" value="Actualizar Venta">
</form>

</body>
</html>
