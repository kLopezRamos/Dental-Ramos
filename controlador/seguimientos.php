<?php
if(!empty($_POST["crear_seguimiento"])){
    if(!empty($_POST["nombre_seguimiento"]) and !empty($_POST["fecha-inicio"])){
      
        $nombre_seguimiento=$_POST["nombre_seguimiento"];
        $fecha_inicio=$_POST["fecha-inicio"];


        $sql_verificar = $conexion->query("SELECT * FROM seguimiento WHERE 
        TRIM(no_expediente) = TRIM('$no_expediente') AND 
        TRIM(nombre_segui) = TRIM('$nombre_seguimiento') AND 
        TRIM(fechainicio_segui) = TRIM('$fecha_inicio')");

         if ($sql_verificar->num_rows == 0) {
            $sql = $conexion->query("insert into seguimiento(no_expediente, nombre_segui, fechainicio_segui) 
            values('$no_expediente','$nombre_seguimiento', '$fecha_inicio')");
         }else{
            echo'Seguimiento ya existente en el expediente.<br></br>';
         }

    }else{
        echo '<div class="alert alert-danger">Alguno de los campos está vacío <br></div>';
     
}

}
?>