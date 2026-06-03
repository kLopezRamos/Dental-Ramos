<?php

if(isset($_POST['modificar_tratamiento'])){
    if(!empty($_POST["diagnostico"]) and !empty($_POST["total"])){
        $observaciones_trat = $_POST['observaciones'];
        $tratamiento_trat = $_POST['diagnostico'];
        $medicamento_trat = $_POST['medicamentos'];
        $evaluar_proxima = $_POST['evaluar'];
        $precio_trat = $_POST['total'];
        
        $sql2 = $conexion->query("update tratamiento 
        set observaciones_trat = '$observaciones_trat', medicamento_trat = '$medicamento_trat', tratamiento_trat = '$tratamiento_trat', evaluar_proxima ='$evaluar_proxima', precio_trat = '$precio_trat' where no_tratamiento='$no_tratamiento'");
        if($sql2==1){

            $url = "../expedientes/tratamientos.php?no_seguimiento=$no_seguimiento" 
            . (isset($no_cita) ? "&no_cita=$no_cita" : "") 
            . "&id_paciente=$id_paciente&nombre_seguimiento=" . urlencode($nom_seguimiento);
            ?>
            <script type="text/javascript">
            window.location.href = '<?php echo $url; ?>';
            </script>

            <?php
            /*header("Location: ../expedientes/tratamientos.php?no_seguimiento=$no_seguimiento" 
    . (isset($no_cita) ? "&no_cita=$no_cita" : "") 
    . "&id_paciente=$id_paciente&nombre_seguimiento=$nom_seguimiento");*/

            //header("Location: ../expedientes/tratamientos.php?no_seguimiento=$no_seguimiento&no_cita=$no_cita&id_paciente=$id_paciente&nombre_seguimiento=$nom_seguimiento");
           
        }else{
            echo '<div class="alert alert-danger">ERROR al modificar reporte</div>';
        }
    
    }else{
        echo '<div class="alert alert-warning">Fvor de compeltar campos Diagnostico y Total($)</div>';
    }
    }

?>