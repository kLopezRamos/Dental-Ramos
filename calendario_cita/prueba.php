<?php
    include "../modelo/conexion.php";
    function validarCita($fecha, $hora, $id_empleado, $conexion) {
        // Realizamos la consulta a la base de datos
        $validacion = $conexion->query("SELECT * FROM cita WHERE id_empleado = '$id_empleado' AND hora_cita = '$hora' AND fecha_cita = '$fecha'");
        
        // Si se encuentra algún registro, significa que ya hay una cita
        if ($validacion->num_rows > 0) {
            echo "Ya hay una cita agendada";
        } else {
            echo "No hay citas en ese horario";
        }
    }
    
    validarCita('1/10/2024', '9am', 2, $conexion);
     ?>