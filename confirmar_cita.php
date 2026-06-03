<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include "modelo/conexion.php";
    if(isset($_GET['no_cita'])){
        $no_cita=$_GET['no_cita'];
        $sql_conformacion=$conexion->query("UPDATE cita SET confirmada = 1 WHERE no_cita = '$no_cita'");
        if($sql_conformacion){
            echo 'Su cita ha sido confirmada';
        }
    }
    
    ?>
    
</body>
</html>