<?php 
if (!empty($_POST["registrar"])) {
    if (!empty($_POST["primer-nombre"]) && 
        !empty($_POST["apellido-pa"]) && 
        !empty($_POST["apellido-ma"]) && 
        !empty($_POST["fecha-na"]) && 
        !empty($_POST["edad"]) &&
        !empty($_POST["ocupacion"]) &&  
        !empty($_POST["correo"]) && 
        !empty($_POST["telefono"]) &&
        !empty($_POST["usuario"]) && 
        !empty($_POST["contrasena"])) {
        // Asignar valores de $_POST a variables
        $primer_nombre = $_POST["primer-nombre"];
        $segundo_nombre = !empty($_POST["segundo-nombre"]) ? $_POST["segundo-nombre"] : ''; // Manejar si está vacío
        $apellido_pa = $_POST["apellido-pa"];
        $apellido_ma = $_POST["apellido-ma"];
        $fecha_na = $_POST["fecha-na"];
        $edad_empleado = $_POST["edad"];
        $ocupacion = $_POST["ocupacion"];
        $correo = $_POST["correo"];
        $telefono = $_POST["telefono"];
        $usuario=$_POST["usuario"]; 
        $contrasena=$_POST["contrasena"];

        // Consultar si el empelado ya existe usando trim para que elimine espacios adicionales creados en los extremos de los nombres y apellidos
        //hace el query mas efectivo
        $query = $conexion->query("SELECT * FROM empleado WHERE 
        TRIM(pnom_empleado) = TRIM('$primer_nombre') AND 
        TRIM(snom_empleado) = TRIM('$segundo_nombre') AND 
        TRIM(apellidopa_empleado) = TRIM('$apellido_pa') AND 
        TRIM(apellidoma_empleado) = TRIM('$apellido_ma') AND 
        fecha_nacimiento_emp = '$fecha_na'");


        if ($query->num_rows == 0) {
            // El empelado no existe, proceder a la inserción
            $sql = $conexion->query("INSERT INTO empleado 
                (pnom_empleado, snom_empleado, apellidopa_empleado, apellidoma_empleado, 
                 fecha_nacimiento_emp, edad_empleado, ocupacion_empleado, correo, telefono_empleado, usuario, contrasena) 
                VALUES ('$primer_nombre', '$segundo_nombre', '$apellido_pa', '$apellido_ma', 
                        '$fecha_na', '$edad_empleado','$ocupacion', '$correo', '$telefono','$usuario', '$contrasena')");

            // Comprobar si se ha insertado el empelado correctamente
            if ($sql) {
                ?>
                <script type="text/javascript">
                window.location.href = './ver_empleados.php';
                </script>
    
                <?php
            } else {
                echo '<div class="alert alert-danger">ERROR al registrar empleado</div>';
            }
        } else {

            echo '<div class="alert alert-success">El empleado que se intentó registrar ya existe <a class="btn btn-success mt-3" href="ver_empleados.php">Buscar empleado</a></div>';

        }
    } else {
        echo "Alguno de los campos está vacío";
    }
}
?>
