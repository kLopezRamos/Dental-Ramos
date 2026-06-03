<?php
if(!empty($_POST["registrar"])){
    if(!empty($_POST["primer-nombre"]) and !empty($_POST["apellido-pa"]) and !empty($_POST["apellido-ma"]) and !empty($_POST["fecha-na"]) and !empty($_POST["edad"])and !empty($_POST["ocupacion"]) and !empty($_POST["telefono"])and !empty($_POST["usuario"])and !empty($_POST["contrasena"])){
        $id=$_POST["id"];
        $primer_nombre=$_POST["primer-nombre"];
        $segundo_nombre=$_POST["segundo-nombre"];
        $apellido_pa=$_POST["apellido-pa"];
        $apellido_ma=$_POST["apellido-ma"];
        $fecha_na=$_POST["fecha-na"];
        $edad=$_POST["edad"];
        $ocupacion=$_POST["ocupacion"];
        $correo=$_POST["correo"];
        $telefono=$_POST["telefono"];
        $usuario=$_POST["usuario"];
        $contrasena=$_POST["contrasena"];
        $sql=$conexion->query("update empleado set pnom_empleado='$primer_nombre', snom_empleado='$segundo_nombre',apellidopa_empleado='$apellido_pa',apellidoma_empleado='$apellido_ma',fecha_nacimiento_emp=' $fecha_na',edad_empleado ='$edad',ocupacion_empleado='$ocupacion',correo=' $correo',telefono_empleado=' $telefono', usuario='$usuario', contrasena='$contrasena' where id_empleado='$id'");
        if($sql==1){
            ?>
           
            <script type="text/javascript">
            window.location.href = 'ver_empleados.php';
            </script>

            <?php
          
            //header("location:ver_empleados.php");
        }else{
            echo '<div class="alert alert-danger">ERROR al modificar empleado</div>';
        }
    }else{
        echo '<div class="alert alert-warning">Hay campos vacios</div>';
    }
}
?>