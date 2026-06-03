<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    

<?php
    $no_tratamiento = $_GET['no_tratamiento'];
    $no_seguimiento= $_GET['no_seguimiento'];
    $nom_seguimiento=$_GET['nombre_seguimiento'];
    //CAMBIO SOLAMENTE DEFINIR NO CITA SI ESTA EN LA URL
    if (isset($_GET['no_cita'])) {
      $no_cita = $_GET['no_cita'];
  }

    //$no_cita = $_GET['no_cita'];
    $id_paciente = $_GET['id_paciente'];
    $datos_evaluar = $_GET['datos_evaluar'];

    include "../modelo/conexion.php";

    $sql =$conexion->query("SELECT * 
    FROM tratamiento 
    WHERE no_tratamiento = '$no_tratamiento'");
    $datos = $sql->fetch_object();

 //CAMBIO AGREGUE MOTIVO_CITA A TABLA TRATAMIENTO VARCHAR
    $sql1 = $conexion->query("SELECT fecha_cita, motivo_cita 
    FROM tratamiento 
    WHERE no_tratamiento = '$no_tratamiento'");
    $datos1 = $sql1->fetch_object();
    $fecha_cita = $datos1->fecha_cita;
    $fecha_convertida = date("d-m-Y", strtotime($fecha_cita));
    $motivo_cita = $datos1->motivo_cita;
    

    $sql3 = $conexion->query("SELECT pnom_paciente, apellidopa_paciente 
    FROM paciente 
    WHERE id_paciente = '$id_paciente'");
    $datos3 = $sql3->fetch_object();
    $pnom_paciente = $datos3->pnom_paciente;
    $apellidopa_paciente=$datos3->apellidopa_paciente;

    ?>
<div class="container-fluid">
    <div class="row mt-5">

        <!-- Botón de volver alineado a la izquierda -->
<!--CAMBIO SOLAMENTE PASAR NO_CITA SI NO CITA ETSA DEFINIDA-->
        <div class="col-4 text-start">
            <a href="../expedientes/tratamientos.php?no_seguimiento=<?=$no_seguimiento?><?php echo isset($no_cita) ? '&no_cita=' . $no_cita : ''; ?>&id_paciente=<?=$id_paciente?>&nombre_seguimiento=<?=$nom_seguimiento?>" class="btn btn-primary">
                <i class="fa-solid fa-arrow-left"></i> Volver
            </a>
        </div>
        
        <!-- Texto centrado -->
        <div class="col-4 text-center">
            <h3 class="text-dark">Reporte cita del <?=$fecha_convertida?> <br></h3>
            <h5 class="text-secondary">Paciente: <?=$pnom_paciente?> <?=$apellidopa_paciente?></h5>
            <h5 class="text-secondary">Motivo de cita: <?=$motivo_cita?></h5>
        </div>
        
        
        <!-- Botón de nuevo reporte alineado a la derecha -->
        <div class="col-4 text-end">
        <?php
  //SOLAMENTE ASIGNAR LA VARIABLE NO_CITA SI ESTA ESTA DISPONIBLE
  if(isset($no_cita)){
    //CAMBIO AGREGUE MOTIVO_CITA A TABLA TRATAMIENTO VARCHAR
include "../modelo/conexion.php";
$sql_revision=$conexion->query("SELECT no_cita FROM tratamiento WHERE no_cita ='$no_cita'");
    ?>
    <a class="btn btn-primary mt-3 m-5 <?php echo ($sql_revision->num_rows > 0) ? 'disabled' : '';?>" 
 href="agregar_tratamiento.php?no_seguimiento=<?=$no_seguimiento?>&no_cita=<?=$no_cita?>&id_paciente=<?=$id_paciente?>&evaluar=<?=$datos_evaluar?>&nom_seguimiento=<?=$nom_seguimiento?>">
 <i class="fa-solid fa-folder-plus"></i> Nuevo reporte
</a>
    <?php
  }
?>
        </div>
    </div>
</div>


<form class="col-6 p-3 m-auto" method="POST">

    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Observaciones:</label>
<!--CAMBIO AGREGUE EL VALOR DE OBSERVACIONES PARA QUE ME LAS MUESTRE-->
    <textarea id="comentarios" name="observaciones" rows="4" cols="50" class="form-control" disabled><?=$datos->observaciones_trat?></textarea>
    <div id="emailHelp" class="form-text"></div>
  </div>
   <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Diagnóstico:</label>
    <textarea id="comentarios" name="diagnostico" rows="4" cols="50" class="form-control" disabled><?=$datos->tratamiento_trat?></textarea>
    <div id="emailHelp" class="form-text"></div>
  </div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Medicamentos recetados:</label>
    <textarea id="comentarios" name="medicamentos" rows="4" cols="50" class="form-control" disabled><?=$datos->medicamento_trat?></textarea>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Puntos a evaluar próxima cita:</label>
    <textarea id="comentarios" name="evaluar" rows="4" cols="50" class="form-control" disabled><?=$datos->evaluar_proxima?></textarea>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Total ($):</label>

    <input type="text" class="form-control w-50" disabled id="fechaInicio" name="total" value="<?=$datos->precio_trat?>" >
  </div>

  <?php
    include "../modelo/conexion.php";
    include "../controlador/modificar_tratamiento.php";
    ?>



</body>
</html>