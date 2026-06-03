<?php 
session_start();
if(!empty($_POST["registrar"])){
    if(!empty($_POST["id-paciente"]) and !empty($_POST["id-empleado"]) and !empty($_POST["fecha-cita"]) and !empty($_POST["hora-cita"]) and !empty($_POST["motivo-cita"])){
        $id_paciente=$_POST["id-paciente"];    
        $id_empleado=$_POST["id-empleado"];
        $fecha_cita=$_POST["fecha-cita"];
        $hora_cita=$_POST["hora-cita"];
        $motivo_cita=$_POST["motivo-cita"];

        $query = $conexion->query("SELECT * FROM cita WHERE 
        TRIM(id_paciente) = TRIM('$id_paciente') AND 
        TRIM(id_empleado) = TRIM('$id_empleado') AND 
        TRIM(fecha_cita) = TRIM('$fecha_cita') AND 
        TRIM(hora_cita) = TRIM('$hora_cita')");
        
        if ($query->num_rows == 0){


        $sql=$conexion->query("insert into cita(id_paciente,id_empleado,fecha_cita,hora_cita,motivo_cita)values('$id_paciente','$id_empleado','$fecha_cita','$hora_cita','$motivo_cita')");

        if($sql==1){
            ?>
            <script type="text/javascript">
                window.location.href = '../home.php';
            </script>
            <?php
            //header("location:../home.php");
            //echo '<div class="alert alert-success ">Cita registrada con éxito</div>';
        }else{
            echo '<div class="alert alert-danger">ERROR al registrar cita</div>';
        }
    }else{
        ?>
        <script type="text/javascript">
            window.location.href = '../home.php';
        </script>
        <?php
        //header("location:../home.php");
    }
    }else{
        echo'Alguno de los campos esta vacío';
    }
}

?>