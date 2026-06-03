<?php
if (isset($_POST['enviar'])) {
    // Verifica si se enviaron datos en 'frutas[]'
    if(isset($_POST['oclusion']) and isset($_POST['enfermedades']) and isset($_POST['habitos']) and isset($_POST['otras'])){
        $oclusion = $_POST['oclusion'];
        $enfermedades = $_POST['enfermedades'];
        $habitos = $_POST['habitos'];
        $otras = $_POST['otras'];

        $enfermedades_str = implode(", ", $enfermedades);
        $oclusion_str = implode(", ", $oclusion);
        $otras_str = implode(", ", $otras);
        $habitos_str = implode(", ", $habitos);
        
        // Actualizar la base de datos usando las cadenas convertidas
        $sql = $conexion->query("UPDATE historial_clinico 
            SET enferm_hist = '$enfermedades_str', tejidos_oclusion_hist = '$oclusion_str', otras_condiciones = '$otras_str', habitos_hist = '$habitos_str' 
            WHERE no_expediente = '$no_expediente'");
        
        echo "<script>window.location.reload();</script>";
    }/*else{
        $oclusion = [];
        $enfermedades=[];
        $habitos=[];
        $otras = [];

    }
    // Verifica si hay frutas seleccionadas
    if (!empty($oclusion) and !empty($enfermedades) and !empty($habitos) and !empty($otras)) {
    } */
    else {
        echo "Falta seleccionar algun campo";
    }
   


}

?>