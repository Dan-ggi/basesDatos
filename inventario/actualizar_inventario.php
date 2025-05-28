<?php
    include '../conexion_bd.php';
    $conn=conexion_bd();

    $ID_Inventario = intval($_POST['ID_Inventario']);
    $ID_Producto = $_POST['ID_Producto'];
    $Cantidad_Disponible = $_POST['Cantidad_Disponible'];
    $Fecha_Reposicion = $_POST['Fecha_Reposicion'];

    $sql = "UPDATE Inventario SET 
        ID_Producto='$ID_Producto', 
        Cantidad_Disponible='$Cantidad_Disponible', 
        Fecha_Reposicion='$Fecha_Reposicion' 
    WHERE ID_Inventario=$ID_Inventario";

    mysqli_query($conn, $sql);
    header("Location: inventarios.php");
    mysqli_close($conn);

?>