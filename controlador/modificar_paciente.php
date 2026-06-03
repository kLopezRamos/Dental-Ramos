<?php
if(!empty($_POST["registrar"])){
    if(!empty($_POST["primer-nombre"]) and !empty($_POST["segundo-nombre"]) and !empty($_POST["apellido-pa"]) and !empty($_POST["apellido-ma"]) and !empty($_POST["fecha-na"]) and !empty($_POST["correo"]) and !empty($_POST["telefono"])){
        $id=$_POST["id"];
        $primer_nombre=$_POST["primer-nombre"];
        $segundo_nombre=$_POST["segundo-nombre"];
        $apellido_pa=$_POST["apellido-pa"];
        $apellido_ma=$_POST["apellido-ma"];
        $fecha_na=$_POST["fecha-na"];
        $correo=$_POST["correo"];
        $telefono=$_POST["telefono"];
        $sql=$conexion->query("update paciente set pnom_paciente='$primer_nombre', snom_paciente='$segundo_nombre',apellidopa_paciente='$apellido_pa',apellidoma_paciente='$apellido_ma',fecha_nacimiento_p=' $fecha_na',correo_paciente=' $correo',tel_paciente=' $telefono' where id_paciente=$id");
        if($sql==1){
            ?>
             <script type="text/javascript">
                window.location.href = 'home.php';
            </script>
            <?php
            //header("location:home.php");
        }else{
            echo '<div class="alert alert-danger">ERROR al modificar paciente</div>';
        }
    }else{
        echo '<div class="alert alert-warning">Campos vacios</div>';
    }
}
?>