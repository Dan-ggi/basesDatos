<?php
    include '../conexion_bd.php';
    $conn=conexion_bd();

    $ID_Compra = intval($_POST['ID_Compra']);
    $ID_Cliente = $_POST['ID_Cliente'];
    $ID_Factura = $_POST['ID_Factura'];
    $Cantidad_compras = $_POST['Cantidad_compras'];

    echo $sql = "UPDATE Compras_Clientes SET 
        ID_Cliente='$ID_Cliente', 
        ID_Factura='$ID_Factura', 
        Cantidad_compras='$Cantidad_compras' 
    WHERE ID_Compra=$ID_Compra";

    mysqli_query($conn, $sql);
    header("Location: compras_clientes.php");
    mysqli_close($conn);

?>