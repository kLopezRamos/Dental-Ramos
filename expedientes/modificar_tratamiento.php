<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>


    <?php
    $no_tratamiento = $_GET['no_tratamiento'];
    $no_seguimiento= $_GET['no_seguimiento'];
    $nom_seguimiento=$_GET['nombre_seguimiento'];
  
    $no_tratamiento = $_GET['no_tratamiento'];
    $id_paciente = $_GET['id_paciente'];
      //CAMBIOOOOO agregar no_Cita solamente si esta en la URL
      
    if (isset($_GET['no_cita'])) {
      $no_cita = $_GET['no_cita'];
  }

    include "../modelo/conexion.php";

    $sql =$conexion->query("SELECT * 
    FROM tratamiento 
    WHERE no_tratamiento = '$no_tratamiento'");
    $datos = $sql->fetch_object();

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




        <h3 class="text-center text-dark">Modificar reporte cita del <?=$fecha_convertida?> <br> </h3>
        <h5 class="text-center text-secondary">Paciente: <?=$pnom_paciente?> <?=$apellidopa_paciente?></h5>
        <h5 class="text-center text-secondary">Motivo de cita: <?=$motivo_cita?></h5>

<form class="col-6 p-3 m-auto" method="POST">

    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Observaciones:</label>
    <!--CAMBIO AGREGUE EL VALOR DE OBSERVACIONES PARA QUE ME LAS MUESTRE-->
    <textarea id="comentarios" name="observaciones" rows="4" cols="50" class="form-control"><?=$datos->observaciones_trat?></textarea>
    <div id="emailHelp" class="form-text"></div>
  </div>
   <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Diagnóstico:</label>
    <textarea id="comentarios" name="diagnostico" rows="4" cols="50" class="form-control"><?=$datos->tratamiento_trat?></textarea>
    <div id="emailHelp" class="form-text"></div>
  </div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Medicamentos recetados:</label>
    <textarea id="comentarios" name="medicamentos" rows="4" cols="50" class="form-control"><?=$datos->medicamento_trat?></textarea>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Puntos a evaluar próxima cita:</label>
    <textarea id="comentarios" name="evaluar" rows="4" cols="50" class="form-control"><?=$datos->evaluar_proxima?></textarea>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Total ($):</label>

    <input type="text" class="form-control w-50" id="fechaInicio" name="total" value="<?=$datos->precio_trat?>" >
  </div>

  <?php
    include "../modelo/conexion.php";
    include "../controlador/modificar_tratamiento.php";
    ?>

  <button type="submit" class="btn btn-primary" name="modificar_tratamiento" value="ok">Actualizar reporte</button>
 
</form>
</body>
</html>