<?php
    include '../conexion_bd.php';
    $conn=conexion_bd();

    $ID_Cliente = intval($_POST['ID_Cliente']);
    $Documento = $_POST['Documento'];
    $Nombre = $_POST['Nombre'];
    $Primer_Apellido = $_POST['Primer_Apellido'];
    $Segundo_Apellido = $_POST['Segundo_Apellido']; 
    $Telefono = $_POST['Telefono'];
    $Email = $_POST['Email'];
    $Fecha_Nacimiento = $_POST['Fecha_Nacimiento'];

    echo $sql = "UPDATE Clientes SET 
        Documento='$Documento', 
        Nombre='$Nombre', 
        Primer_Apellido='$Primer_Apellido', 
        Segundo_Apellido='$Segundo_Apellido', 
        Telefono='$Telefono', 
        Email='$Email', 
        Fecha_Nacimiento='$Fecha_Nacimiento' 
    WHERE ID_Cliente=$ID_Cliente";

    mysqli_query($conn, $sql);
    header("Location: clientes.php");
    mysqli_close($conn);

?>