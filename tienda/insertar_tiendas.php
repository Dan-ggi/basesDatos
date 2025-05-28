<?php
include '../conexion_bd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_tienda = $_POST['Nombre_Tienda'];
    $id_ubicacion = $_POST['ID_Ubicacion'];

    // Validar que ambos campos vienen correctamente
    if (!empty($nombre_tienda) && !empty($id_ubicacion)) {
        $conn = conexion_bd();

        // Prevenir inyección SQL
        $nombre_tienda = mysqli_real_escape_string($conn, $nombre_tienda);
        $id_ubicacion = intval($id_ubicacion);

        $sql = "INSERT INTO Tiendas (Nombre_Tienda, ID_Ubicacion) VALUES ('$nombre_tienda', $id_ubicacion)";

        if (mysqli_query($conn, $sql)) {
            header("Location: tiendas.php"); // redirigir después de insertar
            exit;
        } else {
            echo "Error al insertar tienda: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        echo "Todos los campos son obligatorios.";
    }
} else {
    echo "Acceso no permitido.";
}
?>
