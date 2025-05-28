<?php
    include '../conexion_bd.php';
    $conn=conexion_bd();

    $ID_Venta = intval($_POST['ID_Venta']);
    $ID_Factura = $_POST['ID_Factura'];
    $ID_Tienda = $_POST['ID_Tienda'];
    $ID_Cliente = $_POST['ID_Cliente'];
    $ID_Metodo_Pago = $_POST['ID_Metodo_Pago'];
    $Fecha_Venta = $_POST['Fecha_Venta'];
    $Total_Venta = $_POST['Total_Venta'];

    echo $sql = "UPDATE Ventas SET 
        ID_Factura='$ID_Factura', 
        ID_Tienda='$ID_Tienda', 
        ID_Cliente='$ID_Cliente', 
        ID_Metodo_Pago='$ID_Metodo_Pago', 
        Fecha_Venta='$Fecha_Venta', 
        Total_Venta='$Total_Venta' 
    WHERE ID_Venta=$ID_Venta";

    mysqli_query($conn, $sql);
    header("Location: ventas.php");
    mysqli_close($conn);

?>