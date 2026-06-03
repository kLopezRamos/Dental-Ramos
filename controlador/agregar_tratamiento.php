<?php
if (isset($_POST['crear_tratamiento'])){
    if(!empty($_POST["diagnostico"]) and !empty($_POST["total"])){
        $observaciones_trat = $_POST['observaciones'];
        $tratamiento_trat = $_POST['diagnostico'];
        $medicamento_trat = $_POST['medicamentos'];
        $evaluar_proxima = $_POST['evaluar'];
        $precio_trat = $_POST['total'];
        
        $sql_verificar=$conexion->query("SELECT no_cita FROM tratamiento WHERE no_cita ='$no_cita'");

         if ($sql_verificar->num_rows == 0) {

        $sql2 = $conexion->query("insert into tratamiento (no_seguimiento, observaciones_trat, medicamento_trat, tratamiento_trat, evaluar_proxima, precio_trat, fecha_cita, no_cita,motivo_cita)
        values('$no_seguimiento', '$observaciones_trat', '$medicamento_trat', '$tratamiento_trat', '$evaluar_proxima', '$precio_trat', '$fecha_cita', '$no_cita', '$motivo_cita')");
       

        if($sql2 === TRUE) {
            ?>
            <script type="text/javascript">
            window.location.href = ' ../expedientes/tratamientos.php?no_seguimiento=<?=$no_seguimiento?>&no_cita=<?=$no_cita?>&id_paciente=<?=$id_paciente?>&nombre_seguimiento=<?=$nom_seguimiento?>';
            </script>

            <?php

        }else{
            echo '<div class="alert alert-danger">ERROR al registrar tratamiento</div>';
        }
        }else{
            ?>
            <script type="text/javascript">
            window.location.href = ' ../expedientes/tratamientos.php?no_seguimiento=<?=$no_seguimiento?>&no_cita=<?=$no_cita?>&id_paciente=<?=$id_paciente?>&nombre_seguimiento=<?=$nom_seguimiento?>';
            </script>

            <?php
            //header("Location: ../expedientes/tratamientos.php?no_seguimiento=$no_seguimiento&no_cita=$no_cita&id_paciente=$id_paciente&nombre_seguimiento=$nom_seguimiento");
            //echo 'Tratamiento para esta cita ya creado';
            //CAMBIOS REALIZADOS
        }

    }else{
        echo '<div class="alert alert-danger">Favor de ingresar diagnóstico y total($)</div>';
    }
}
?>