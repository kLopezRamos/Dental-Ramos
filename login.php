<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style_login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abhaya+Libre:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <form action="validar.php" method="post">
    <h1 id="inicio">Iniciar Sesión</h1>
    <h1 class="usuariocontra">Usuario:<input type="text" placeholder="Ingrese su usuario" name="usuario"></h1>
    <h1 class="usuariocontra">Contraseña:<input type="password" placeholder="Ingrese su contraseña" name="contrasena"></h1>
    <input type="submit" value="Ingresar">
    </form>
</body>
</html>