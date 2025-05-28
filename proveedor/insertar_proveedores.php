<?php
include '../conexion_bd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['Nombre'];
    $telefono = $_POST['Telefono'];
    $email = $_POST['Email'];

    if (!empty($nombre) && !empty($telefono) && !empty($email)) {
        $conn = conexion_bd();

        // Sanitizar datos
        $nombre = mysqli_real_escape_string($conn, $nombre);
        $telefono = mysqli_real_escape_string($conn, $telefono);
        $email = mysqli_real_escape_string($conn, $email);

        $sql = "INSERT INTO Proveedores (Nombre, Telefono, Email) 
                VALUES ('$nombre', '$telefono', '$email')";

        if (mysqli_query($conn, $sql)) {
            header("Location: proveedores.php");
            exit;
        } else {
            echo "Error al registrar proveedor: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        echo "Todos los campos son obligatorios.";
    }
} else {
    echo "Acceso denegado.";
}
?>
