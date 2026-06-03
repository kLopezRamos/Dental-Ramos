<?php 
if (!empty($_POST["registrar"])) {
    if (!empty($_POST["primer-nombre"]) && 
        !empty($_POST["apellido-pa"]) && 
        !empty($_POST["apellido-ma"]) && 
        !empty($_POST["fecha-na"]) && 
        !empty($_POST["edad_paciente"]) && 
        !empty($_POST["correo"]) && 
        !empty($_POST["telefono"])) {
        
        // Asignar valores de $_POST a variables
        $primer_nombre = $_POST["primer-nombre"];
        $segundo_nombre = !empty($_POST["segundo-nombre"]) ? $_POST["segundo-nombre"] : ''; // Manejar si está vacío
        $apellido_pa = $_POST["apellido-pa"];
        $apellido_ma = $_POST["apellido-ma"];
        $fecha_na = $_POST["fecha-na"];
        $edad_paciente = $_POST["edad_paciente"];
        $correo = $_POST["correo"];
        $telefono = $_POST["telefono"];

        // Consultar si el paciente ya existe usando trim para que elimine espacios adicionales creados en los extremos de los nombres y apellidos
        //hace el query mas efectivo
        $query = $conexion->query("SELECT * FROM paciente WHERE 
        TRIM(pnom_paciente) = TRIM('$primer_nombre') AND 
        TRIM(snom_paciente) = TRIM('$segundo_nombre') AND 
        TRIM(apellidopa_paciente) = TRIM('$apellido_pa') AND 
        TRIM(apellidoma_paciente) = TRIM('$apellido_ma') AND 
        fecha_nacimiento_p = '$fecha_na'");


        if ($query->num_rows == 0) {
            // El paciente no existe, proceder a la inserción
            $sql = $conexion->query("INSERT INTO paciente 
                (pnom_paciente, snom_paciente, apellidopa_paciente, apellidoma_paciente, 
                 fecha_nacimiento_p, edad_paciente, correo_paciente, tel_paciente) 
                VALUES ('$primer_nombre', '$segundo_nombre', '$apellido_pa', '$apellido_ma', 
                        '$fecha_na', '$edad_paciente', '$correo', '$telefono')");

            // Comprobar si se ha insertado el paciente correctamente
            if ($sql) {
                // Obtener el último ID insertado en la tabla `paciente`
                $id_paciente = $conexion->insert_id;

                // Insertar el expediente usando el ID del paciente
                $sql_expediente = $conexion->query("INSERT INTO expediente(id_paciente) VALUES('$id_paciente')");

                if ($sql_expediente) {
                    echo '<div class="alert alert-success">Paciente y expediente registrados correctamente <a class="btn btn-success mt-3" href="calendario_cita/formulario_cita.php?id='. $id_empleado .'&id_paciente=' . $id_paciente . '&fecha=' . $fecha_cita . '&hora=' . $hora_cita . '">Continuar</a></div>';
                                //concatena cadena de texto HTML Y php hasta id= y despues va variable concatenada con un . y depsues se vuelve a abrir otra cadena php y otra variable y asi sucesivamente
                                //echo ' '.$id_paciente . ' ';
                               // echo '<a class="btn btn-success mt-3" href="calendario_cita/formulario_cita.php?id='. $id_empleado .'&id_paciente=' . $id_paciente . '&fecha=' . $fecha_cita . '&hora=' . $hora_cita . '">Continuar</a>';
                                //otraforma de poner el boton
                            // echo '<a class="btn btn-success mt-3" href="calendario_cita/formulario_cita.php?id=''">Continuar</a>';

                } else {
                    echo '<div class="alert alert-danger">ERROR al registrar expediente</div>';
                }
            } else {
                echo '<div class="alert alert-danger">ERROR al registrar paciente</div>';
            }
        } else {

            echo '<div class="alert alert-success">El paciente que se intentó registrar ya existe <a class="btn btn-success mt-3" href="home.php">Buscar paciente</a></div>';

        }
    } else {
        echo "Alguno de los campos está vacío";
    }
}
?>
