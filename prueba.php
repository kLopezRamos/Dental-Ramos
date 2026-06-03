<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
 .contenedor-rojo {
    display: flex;
    justify-content: center; /* Centra el contenido */
    align-items: center;
    background-color: red; /* Fondo rojo */
    padding: 10px;
    border-radius: 8px;
    width: fit-content; /* Se ajusta al contenido */
    margin: 20px auto; /* Centra en la página */
}

.contenedor-filas {
    display: flex;
    flex-direction: column; /* Apila los elementos en columna */
    gap: 10px;
}

.fila-nombre {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    text-align: center;
    font-weight: bold;
    width: fit-content;
}


    </style>
</head>
<body>
<?php
    include "./modelo/conexion.php";

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT pnom_paciente FROM paciente";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    echo '<div class="contenedor-rojo">'; // Contenedor rojo
    echo '<div class="contenedor-filas">'; // Contenedor de nombres

    while ($fila = $resultado->fetch_assoc()) {
        echo '<div class="fila-nombre">' . htmlspecialchars($fila["pnom_paciente"]) . '</div>';
    }

    echo '</div>';
    echo '</div>';
} else {
    echo "No hay nombres registrados.";
}

$conexion->close();
?>


</body>
</html>