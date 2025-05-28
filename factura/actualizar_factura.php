<?php
    include '../conexion_bd.php';
    $conn = conexion_bd();

    // Corregir las claves de POST
    $ID_Factura = $_POST['ID_Factura'];
    $ID_Cliente = $_POST['ID_Cliente'];
    $Fecha = $_POST['Fecha'];
    $Monto_Total = $_POST['Monto_Total'];

    // Evitar inyecciones SQL mínimamente
    $ID_Factura = mysqli_real_escape_string($conn, $ID_Factura);
    $ID_Cliente = mysqli_real_escape_string($conn, $ID_Cliente);
    $Fecha = mysqli_real_escape_string($conn, $Fecha);
    $Monto_Total = mysqli_real_escape_string($conn, $Monto_Total);

    $sql = "UPDATE Facturas SET 
        ID_Cliente = '$ID_Cliente',
        Fecha = '$Fecha',
        Monto_Total = '$Monto_Total'
        WHERE ID_Factura = '$ID_Factura'";

    mysqli_query($conn, $sql) or die("Error en la consulta: " . mysqli_error($conn));
    mysqli_close($conn);

    header("Location: facturas.php");
    exit();
?>
