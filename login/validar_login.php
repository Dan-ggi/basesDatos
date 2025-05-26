<?php
//INICIAR EL ARREGLO SESION (Que es para manejo de sesiones)
session_start();
include '../conexion_bd.php';
$conn= conexion_bd();

//OBTENER LOS DATOS DEL FORMULARIO
$usuario= $_POST['nombre_usuario'];
$password= $_POST['password'];

//BUSCAR (VERIFICAR) EL USUARIO EN LA BASE DE DATOS
$sql = "SELECT * FROM Usuarios_Web WHERE nombre_usuario = '$usuario'";
$resultado = mysqli_query($conn, $sql);

if ($fila = mysqli_fetch_assoc($resultado)){
    //Verificar la Contraseña
    if(password_verify($password, $fila['password'])){
        //INICIAR SESION
        $_SESSION['usuario']= $usuario;
        $_SESSION['id_empleado']= $fila['empleado_id'];
        header("Location: /empresa/panel_control.php");
        exit;
    }
}
mysqli_close($conn);
header("Location: login.php?error=1");
exit;
?>