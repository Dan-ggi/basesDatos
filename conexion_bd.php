<?php
    // Función para conectar a la base de datos
    function conexion_bd(){
        $servidor="190.121.154.40";
        $usuario="82202315529";
        $pasword="1002566909@Bd1";
        $bd="DB5529_Walkmar";


        // Crear conexión
        $conn=mysqli_connect($servidor,$usuario,$pasword);
        mysqli_select_db($conn,$bd);
        return $conn;
    }
?>