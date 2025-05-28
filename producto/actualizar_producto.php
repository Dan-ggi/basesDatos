<?php
    include '../conexion_bd.php';
    $conn=conexion_bd();

    $ID_Producto = intval($_POST['ID_Producto']);
    $ID_Cliente = intval($_POST['ID_Cliente']);
    $Nombre_Producto = $_POST['Nombre_Producto'];
    $Categoria = $_POST['Categoria'];
    $Subcategoria = $_POST['Subcategoria'];

    $sql = "UPDATE Productos SET 
        Nombre_Producto='$Nombre_Producto', 
        Categoria='$Categoria', 
        Subcategoria='$Subcategoria' 
    WHERE ID_Producto=$ID_Producto";

    mysqli_query($conn, $sql);
    header("Location: productos.php");
    mysqli_close($conn);

?>