<?php
// MANEJO DE SESIONES
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
// FIN MANEJO DE SESIONES

include '../conexion_bd.php';
$conn = conexion_bd();

// Validar y obtener el id del producto_tienda desde la URL
$id_producto_tienda = isset($_GET['id_producto_tienda']) ? intval($_GET['id_producto_tienda']) : 0;
if ($id_producto_tienda <= 0) {
    die("Error: ID del producto-tienda no válido.");
}

// Consulta de datos actuales del producto_tienda
$sql = "SELECT * FROM Producto_Tienda WHERE id_producto_tienda = $id_producto_tienda";
$resultado = mysqli_query($conn, $sql);

if (!$resultado || mysqli_num_rows($resultado) == 0) {
    die("Error: No se encontraron datos para actualizar.");
}

$fila = mysqli_fetch_assoc($resultado);
if (!$fila) {
    die("Error: No se encontró el registro para id_producto_tienda = $id_producto_tienda");
}

// Ajustar nombres de columna según base de datos
$id_producto = $fila['ID_Producto'] ?? $fila['id_producto'] ?? null;
$id_tienda = $fila['ID_Tienda'] ?? $fila['id_tienda'] ?? null;

if ($id_producto === null || $id_tienda === null) {
    die("Error: Las columnas ID_Producto o ID_Tienda no existen en la tabla.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Producto-Tienda</title>
</head>
<body>
    <form action="actualizar_producto_tienda.php" method="POST">
        <input type="hidden" name="id_producto_tienda" value="<?php echo htmlspecialchars($id_producto_tienda); ?>">

        <!-- SELECT TIENDA -->
        <label for="tienda_id">Tienda:</label><br>
        <select id="tienda_id" name="ID_Tienda" required>
            <option value="">Seleccione la tienda</option>
            <?php
            $sql_tiendas = "SELECT ID_Tienda, Nombre_Tienda FROM Tiendas ORDER BY Nombre_Tienda ASC";
            $resultado_tiendas = mysqli_query($conn, $sql_tiendas);

            if (!$resultado_tiendas) {
                echo "<option>Error al obtener tiendas: " . mysqli_error($conn) . "</option>";
            } elseif (mysqli_num_rows($resultado_tiendas) == 0) {
                echo "<option>No hay tiendas registradas</option>";
            } else {
                while ($tienda = mysqli_fetch_assoc($resultado_tiendas)) {
                    $selected = ($tienda['ID_Tienda'] == $id_tienda) ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($tienda['ID_Tienda']) . "' $selected>" . htmlspecialchars($tienda['Nombre_Tienda']) . "</option>";
                }
            }
            ?>
        </select><br><br>

        <!-- SELECT CLIENTE (si necesitas que se seleccione alguno por defecto, ajusta aquí) -->
        <label for="cliente_id">Cliente:</label><br>
        <select id="cliente_id" name="ID_Cliente" required>
            <option value="">Seleccione el cliente</option>  
            <?php
            $sql_cliente = "SELECT ID_Cliente, Nombre, Primer_Apellido, Documento FROM Clientes ORDER BY Nombre ASC";
            $resultado_cliente = mysqli_query($conn, $sql_cliente);

            if (!$resultado_cliente) {
                echo "<option>Error al obtener clientes: " . mysqli_error($conn) . "</option>";
            } elseif (mysqli_num_rows($resultado_cliente) == 0) {
                echo "<option>No hay clientes registrados</option>";
            } else {
                while ($cliente = mysqli_fetch_assoc($resultado_cliente)) {
                    // Aquí no tenemos un cliente seleccionado por defecto, pero podrías agregar lógica similar
                    echo "<option value='" . htmlspecialchars($cliente['ID_Cliente']) . "'>" 
                        . htmlspecialchars($cliente['Nombre']) . " " 
                        . htmlspecialchars($cliente['Primer_Apellido']) . " - Doc: " 
                        . htmlspecialchars($cliente['Documento']) . 
                        "</option>";
                }
            }
            ?>
        </select><br><br>   

        <!-- SELECT PRODUCTO -->
        <label for="producto_id">Producto:</label><br>
        <select id="producto_id" name="ID_Producto" required>
            <option value="">Seleccione el producto</option>
            <?php
            $sql_producto = "SELECT ID_Producto, Nombre_Producto FROM Productos ORDER BY Nombre_Producto ASC";
            $resultado_producto = mysqli_query($conn, $sql_producto);

            if (!$resultado_producto) {
                echo "<option>Error al obtener productos: " . mysqli_error($conn) . "</option>";
            } elseif (mysqli_num_rows($resultado_producto) == 0) {
                echo "<option>No hay productos registrados</option>";
            } else {
                while ($producto = mysqli_fetch_assoc($resultado_producto)) {
                    $selected = ($producto['ID_Producto'] == $id_producto) ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($producto['ID_Producto']) . "' $selected>" 
                        . htmlspecialchars($producto['Nombre_Producto']) . "</option>";
                }
            }
            ?>
        </select><br><br>

        <input type="submit" value="Actualizar Producto-Tienda">
    </form>
</body>
</html>
