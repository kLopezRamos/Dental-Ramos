<?php
session_start();
include('modelo/conexion.php');

// Variables
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

// Código en base a phpMyAdmin
$consulta = "SELECT * FROM empleado WHERE BINARY usuario = ? AND BINARY contrasena = ?";
$stmt = mysqli_prepare($conexion, $consulta);
mysqli_stmt_bind_param($stmt, 'ss', $usuario, $contrasena);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

$filas = mysqli_num_rows($resultado);

if ($filas > 0) {
    // Obtenemos los datos del usuario
    $user = mysqli_fetch_assoc($resultado);
    
    // Almacenamos el usuario y el rol en la sesión
    $_SESSION['usuario'] = $user['usuario']; // Asegúrate de usar la columna correcta
    $_SESSION['rol'] = $user['rol']; // Guardamos el rol, 'admin' o 'user'
    $_SESSION['pnom_empleado'] = $user['pnom_empleado'];
    $_SESSION['apellidopa_empleado']=$user['apellidopa_empleado'];
    
    header("Location: home.php");
    exit(); // Importante para detener la ejecución del script
} else {
    // Si los datos son incorrectos, mostramos el mensaje y regresamos al login
    include("login.php");
    echo '<h1 class="bad">DATOS INCORRECTOS</h1>';
}

// Liberar el resultado y cerrar la conexión
mysqli_free_result($resultado);
mysqli_close($conexion);
?>