<?php
if(!empty($_GET["id"])){
    $id=$_GET["id"];
    $sql=$conexion->query(" delete from paciente where id_paciente=$id ");
    if($sql==1){
    }else{
        echo '<div class="alert alert-warning">Error al eliminar</div>';
    }
}
?>