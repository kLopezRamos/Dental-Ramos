<?php
if (isset($_POST["generar"])) {
    //CAMBIO ELIMINE !empty($_POST["snom_paciente"])
    if(!empty($_POST["primer-nombre"]) and !empty($_POST["apellido-pa"]) and !empty($_POST["apellido-ma"]) and !empty($_POST["diagnostico"]) and !empty($_POST["rfc_paciente"]) and !empty($_POST["nombre_consultorio"]) and !empty($_POST["rfc_consultorio"]) and !empty($_POST["total"]) and !empty($_POST["metodo_pago"])){
        $primer_nombre=$_POST["primer-nombre"];
        $segundo_nombre=$_POST["segundo-nombre"];
        $apellidopa=$_POST["apellido-pa"];
        $apellidoma=$_POST["apellido-ma"];
        $diagnostico=$_POST["diagnostico"];
        $fecha_convertida=$_POST["fecha_convertida"];
        $rfc_paciente=$_POST["rfc_paciente"];
        $nombre_consultorio=$_POST["nombre_consultorio"];
        $rfc_consultorio=$_POST["rfc_consultorio"];
        $total=$_POST["total"];
        $metodo_pago=$_POST["metodo_pago"];
        $id_ticket=$_POST["id_ticket"];
        include 'enviar_factura.php';
    }else{
        echo '<div class="alert alert-danger">Algún campo esta vacío</div>';

       
    }
}
?>