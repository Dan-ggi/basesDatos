<?php
    include '../conexion_bd.php';
    $conn=conexion_bd();

    $ID_Ubicacion = intval($_POST['ID_Ubicacion']);
    $Direccion = $_POST['Direccion'];
    $Ciudad = $_POST['Ciudad'];
    $Barrio = $_POST['Barrio'];
    $Departamento = $_POST['Departamento'];

    $sql = "UPDATE Ubicacion SET 
        Direccion='$Direccion', 
        Ciudad='$Ciudad', 
        Barrio='$Barrio', 
        Departamento='$Departamento' 
    WHERE ID_Ubicacion=$ID_Ubicacion";

    mysqli_query($conn, $sql);
    header("Location: ubicaciones.php");
    mysqli_close($conn);

?>