<?php

// Eliminar todas las variables de sesión
$_SESSION = array();

// Si se desea, se puede destruir la sesión
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio o de login
header("Location: login.php"); // Cambia 'login.php' por la página a la que desees redirigir
exit();
?>
