<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimientos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <style>
        body {
            background-color: #e0f7f9;
            margin: 0;
        }

        #barra {
            width: 100%;
            height: 70px;
            background-color: #343a40;
            display: grid;
            grid-template-columns: repeat(2, 50%);
        }

        #calendario {
            color: white;
            font-family: 'Afacad', sans-serif;
            font-size: 15px;
            align-items: center;
            display: flex;
            padding-left: 20px;
        }

        #regresar {
            padding-left: 560px;
            align-items: center;
            font-family: 'Afacad', sans-serif;
            display: flex;
        }

        #back {
            text-decoration-line: none;
            color: black;
            background-color: rgba(126, 226, 228, 1);
            width: 150px;
            height: 55px;
            border-radius: 25px;
            border: 3px solid;
            text-align: center;
            align-items: center;
            display: flex;
            padding-left: 45px;
        }
        
        #back:hover {
            background-color: rgb(97, 164, 164);
        }
    </style>
</head>
<body>
<div id="barra">
        <div id="calendario"><h1>Lista de seguimientos</h1></div>
        <div id="regresar">
            <a href="javascript:window.history.back();" id="back">Regresar</a>
        </div>
    </div>
<?php  
$id_paciente=$_GET["id"];
//CAMBIO definir no cita solamente si esta en la URL
if (isset($_GET['no_cita'])) {
  $no_cita = $_GET['no_cita'];
}

//$no_cita = $_GET['no_cita'];
include "../modelo/conexion.php";
$sql = $conexion->query("SELECT no_expediente FROM expediente WHERE id_paciente = '$id_paciente'");
    $expediente = $sql->fetch_object();
    $no_expediente = $expediente->no_expediente;
?>
<br><br>

<!--FORMULARIO PARA CREAR NUEVO SEGUIMIENTO-->
<div class="container-fluid row " >
<form class="col-3 p-3" method="POST">
<h5 class="text-center text-secondary">Crear nuevo seguimiento</h5>
  
  
    <input type="hidden" name="id" value="">
  
   <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nombre de seguimiento</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nombre_seguimiento" value="">
    <div id="emailHelp" class="form-text"></div>
  </div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Fecha de inicio</label>
    <input type="date" class="form-control" id="fechaInicio" name="fecha-inicio" value="">
  </div>

  <?php
    include "../modelo/conexion.php";
    include "../controlador/seguimientos.php";
    ?>

  <button type="submit" class="btn btn-primary" name="crear_seguimiento" value="ok">Crear seguimiento</button>
 
</form>


<script>
    // Obtener la fecha actual
    const today = new Date();
    
    // Formatear la fecha en YYYY-MM-DD para que sea compatible con el input de tipo date
    const formattedDate = today.toISOString().split('T')[0];

    // Asignar la fecha actual al campo de fecha de inicio
    document.getElementById('fechaInicio').value = formattedDate;
</script>




<!--TABLA DE SEGUIMIENTOS DEL PACIENTE-->
<div class="col-9 p-3">
    
<table class="table">
<h5 class="text-center text-secondary">Seguimientos del paciente</h5>
  <thead>
    <tr>
     
      <th scope="col">Nombre seguimiento</th>
      <th scope="col">Fecha de inicio</th>
      <th scope="col">Fecha Fin</th>
      <th scope="col"  class="text-center">Reportes</th>
     
    </tr>
  </thead>
  <tbody>
    <?php
  
    include "../modelo/conexion.php";

    $sql1 = $conexion->query("SELECT * FROM seguimiento WHERE no_expediente = '$no_expediente'");
    while($datos=$sql1->fetch_object()){
      
      ?>
    <tr>
      <td class="d-none"><?=$datos->no_seguimiento?></td>
      <td><?=$datos->nombre_segui?></td>

      <td>
        <?php
        //CAMBIO
        $fecha_inicio=$datos->fechainicio_segui;
        $fecha_iconvertida = date("d/m/Y", strtotime($fecha_inicio));
        ?>
      <?=$fecha_iconvertida //?>
    </td>

      <td>
    <?php if (is_null($datos->fechafin_segui)) { ?>
        <div class="d-flex align-items-center">
            <form method="POST" class="d-flex">
                <input type="hidden" name="no_seguimiento" value="<?= $datos->no_seguimiento; ?>">
                <input type="date" class="form-control me-2" name="fecha_final" style="max-width: 200px;"> <!-- Ajusta el ancho si es necesario -->
                <button type="submit" class="btn btn-primary" name="agregar_<?= $datos->no_seguimiento; ?>"><i class="fa-solid fa-plus"></i></button>
            </form>
        </div>
            <?php
            // Verifica si el formulario fue enviado usando isset() que verifica si el botón fue presionado
            if (isset($_POST["agregar_" . $datos->no_seguimiento])) {
                if (!empty($_POST["fecha_final"])) {
                    $fecha_final = $_POST['fecha_final'];
                    $no_seguimiento = $_POST['no_seguimiento'];
                    // Actualiza solo el seguimiento correspondiente
                    $sql_fechafin = $conexion->query("UPDATE seguimiento SET fechafin_segui = '$fecha_final' WHERE no_expediente = '$no_expediente' AND no_seguimiento = '$no_seguimiento'");
                    echo "<script>window.location.reload();</script>";
                } else {
                    echo 'Favor de seleccionar una fecha';
                }
            }
            ?>
        </div>
    <?php } else { 
      //CAMBIO
      $fecha_fin=$datos->fechafin_segui;
      $fecha_fconvertida = date("d/m/Y", strtotime($fecha_fin))
      ?>
        <?= $fecha_fconvertida ?>
        
    <?php /* CAMBIO*/ } ?>
</td>

      <td>
      <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
  <!--CAMBIO-->
        <a href="tratamientos.php?no_seguimiento=<?=$datos->no_seguimiento?><?php echo isset($no_cita) ? '&no_cita=' . $no_cita : ''; ?>&id_paciente=<?=$id_paciente?>&nombre_seguimiento=<?=$datos->nombre_segui?>" class="btn btn-small btn-light"><i class="fa-solid fa-file-lines"></i></a>
        </div>
      </td>
 
    
    </tr>  
   <?php }?>
  </tbody>
</table>
</div>



</body>
</html>

<!--<p>Crear nuevo seguimiento</p>
    <p>y buscar la cita que se acaba de tener en el momento para agregarla o arrastrar los datos de la cita y agregarle los detalles del NUEVO TRATAMIENTO que se va a tener, como los medicamentos y etc. </p>
    -->