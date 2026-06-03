<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
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
  
    <?php
    //queries necesarios
    $no_seguimiento= $_GET['no_seguimiento'];
    $nom_seguimiento=$_GET['nombre_seguimiento'];
    $id_paciente = $_GET['id_paciente'];

    //CAMBIO SOLAMENTE DEFINIR VARIABLE SI ESTA PRESENTE EN LA URL
    if (isset($_GET['no_cita'])) {
      $no_cita = $_GET['no_cita'];
  }

 //$no_cita = $_GET['no_cita'];

  
   

  
   
    include "../modelo/conexion.php";
    /*
    $sql= $conexion->query("SELECT fecha_cita FROM cita WHERE no_cita = '$no_cita'");
    $datos = $sql->fetch_object();
    $fecha_cita=$datos->fecha_cita;
  */

  $href = isset($no_cita) ? "../home.php" : "../mostrar_expedientes/mostrar_expedientes.php";

    ?>
    
      <div id="barra">
        <div id="calendario"><h1>Reportes</h1></div>
        <div id="regresar">
          
            <a href="<?=$href?>" id="back">Regresar</a>
        </div>
    </div>
    <h2 class="text-center text-secondary">Reportes seguimiento de <?=$nom_seguimiento?> </h2>
    

    <?php
    $sql_existencia=$conexion->query("SELECT * FROM tratamiento WHERE no_seguimiento = '$no_seguimiento'");
    if ($sql_existencia && $sql_existencia->num_rows > 0) {

      $sql_primer_registro = $conexion->query("SELECT * FROM tratamiento WHERE no_seguimiento = '$no_seguimiento' ORDER BY fecha_cita DESC LIMIT 1");
      $primer_registro = $sql_primer_registro->fetch_object();
    
          $datos_evaluar = $primer_registro->evaluar_proxima; // Asegúrate de que 'id' es el nombre de la columna de ID
          $id_ultima_cita= $primer_registro->no_tratamiento;
    }else{
      $datos_evaluar='N/A';
    }
    ?>

   
<!--CAMBIO boton de nuevo reporte-->

<div class="container-fluid " >
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



    
    <?php
  
    /*
//<?php echo isset($no_cita) ? '&no_cita=' . $no_cita : ''; ?>
 */
    ?>


    


<!--TABLA DE REPORTES DE SEGUIMIENTO-->
<div class="col-8 m-auto">
<table class="table">
<h5 class="text-center text-secondary"></h5>
  <thead>
    <tr>
    <th scope="col">Modifcar</th>
    <th scope="col">Detalles</th>
      <th scope="col">Fecha de consulta</th>
      <th scope="col">Diagnostico</th>
      <th scope="col">Total ($)</th>
      <th scope="col">Pagado</th>
      <th scope="col" style="width: 150px;">Método de pago</th>
      <th scope="col">Enviar ticket</th>
      <th scope="col">Generar factura</th>

     
    </tr>
  </thead>
  <tbody>
    <?php
  
    include "../modelo/conexion.php";

    $sql4 = $conexion->query("SELECT * 
    FROM tratamiento 
    WHERE no_seguimiento = '$no_seguimiento' ORDER BY fecha_cita DESC");

 
    while($datost=$sql4->fetch_object()){ ?>
  
    <?php
        $fecha_cita=$datost->fecha_cita;
        $fecha_convertida = date("d/m/Y", strtotime($fecha_cita));
        $no_tratamiento = $datost->no_tratamiento;
        $precio_trat=$datost->precio_trat;
    ?>
    <tr>
    <!--CAMBIO  agregue que solamente pase la variable no_cita si esta esta definida-->
      <td>
      <a href="modificar_tratamiento.php?<?php echo isset($no_cita) ? '&no_cita=' . $no_cita : ''; ?>&no_tratamiento=<?=$datost->no_tratamiento?>&no_seguimiento=<?=$no_seguimiento?>&id_paciente=<?=$id_paciente?>&nombre_seguimiento=<?=$nom_seguimiento?>" class="btn btn-small btn-warning"><i class="fa-regular fa-pen-to-square"></i></a>
      </td>
      <td>
         <!--CAMBIO SOLAMENTE PASAR NO CITA SI ESTA DEFINIDA-->
      <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
        <a href="ver_tratamiento.php?no_tratamiento=<?=$datost->no_tratamiento?><?php echo isset($no_cita) ? '&no_cita=' . $no_cita : ''; ?>&no_seguimiento=<?=$no_seguimiento?>&no_tratamiento=<?=$no_tratamiento?>&id_paciente=<?=$id_paciente?>&nombre_seguimiento=<?=$nom_seguimiento?>&datos_evaluar=<?=$datos_evaluar?>" class="btn btn-small btn-light"><i class="fa-regular fa-eye"></i></a>
        </div>
      </td>

      <td><?=$fecha_convertida?></td>
      <td><?=$datost->tratamiento_trat?></td>
      <td><?=$precio_trat?></td>
      <td style="text-align: center">
      <?php
      if($datost->pagado == True){
      ?>
      <i class="fa-solid fa-check"></i>
      <?php
      }else{
        ?>
        <i class="fa-solid fa-xmark"></i>
        <?php
      }
      ?>
      </td>
    <td>
      <?php if (is_null($datost->metodo_pago)) { ?>
        <div class="d-flex align-items-center">
            <form method="POST" class="d-flex">
                <input type="hidden" name="no_tratamiento" value="<?= $datost->no_tratamiento; ?>">
                <input type="text" class="form-control me-2" name="metodo_pago" style="max-width: 200px;"> <!-- Ajusta el ancho si es necesario --> 
                <button type="submit" class="btn btn-primary" name="agregar_<?= $datost->no_tratamiento; ?>"><i class="fa-solid fa-plus"></i></button>
            </form>
        </div>
            <?php
            // Verifica si el formulario fue enviado usando isset() que verifica si el botón fue presionado
            if (isset($_POST["agregar_" . $datost->no_tratamiento])) {
                if (!empty($_POST["metodo_pago"])) {
                    $metodo_pago = $_POST['metodo_pago'];
                    $no_tratamiento = $_POST['no_tratamiento'];
                    // Actualiza solo el seguimiento correspondiente
                    $sql_metodo = $conexion->query("UPDATE tratamiento SET metodo_pago = '$metodo_pago' WHERE no_tratamiento = '$no_tratamiento'");
                    echo "<script>window.location.reload();</script>";
                } else {
                  
                  echo 'Favor de ingresar un valor';
                }
            }
            ?>
        </div>
    <?php } else { ?>
        <?=$datost->metodo_pago?>
    <?php } ?>
    </td>
        <?php
        // Verifica si el método de pago es nulo

        $isDisabled = is_null($datost->metodo_pago);
        //false si no es nulo
        //True si es nulo
        ?>
      <td>
        <form  method="POST">
        <input type="hidden" name="no_tratamiento" value="<?= $no_tratamiento; ?>">
        <button type="submit" class="btn btn-small btn-light <?=!$isDisabled ? '' : 'disabled'?>" <?php if ($isDisabled) echo 'onclick="return false;" style="pointer-events: none; opacity: 0.5;"'; ?> name="ticket_<?=$no_tratamiento; ?>" ><i class="fa-solid fa-money-bill"></i></button>
        <?php
        include "./ticket/enviar_correo.php";  // Solo incluye y ejecuta este archivo si se ha enviado el formulario
        ?> 
      </form>
      </td>
<td>
      <?php
 include "../modelo/conexion.php";     
$sql_checar=$conexion->query("SELECT id_ticket FROM ticket WHERE no_tratamiento = '$no_tratamiento'");


// Verifica si existen registros y si el método de pago no es nulo
$isButtonEnabled = !$isDisabled && $sql_checar->num_rows > 0;

// Obtén el método de pago, usando 'no registrado' si es nulo. Se le tiene que dar un valor a la variable apra que pueda ser pasada GET en la URL
$metodo_pago = $isDisabled ? 'no registrado' : $datost->metodo_pago;
?>

<!-- Formulario para enviar los datos por POST -->
<?php
// Construir la URL con las variables
//CAMBIO AGREGUE CONDICIONAL DE NO CITA
$queryParams = [
  'no_tratamiento' => $datost->no_tratamiento,
  'id_paciente' => $id_paciente,
  'diagnostico' => $datost->tratamiento_trat,
  'total' => $precio_trat,
  'metodo_pago' => $metodo_pago,
  'no_seguimiento' => $no_seguimiento,
  'nombre_seguimiento' => $nom_seguimiento,
  'fecha_convertida' => $fecha_convertida,
];

// Solo agrega `no_cita` si está definida
if (isset($no_cita)) {
  $queryParams['no_cita'] = $no_cita;
}

$queryString = http_build_query($queryParams);
$url = './ticket/generar_factura.php?' . $queryString;

?>

<a href="<?= htmlspecialchars($url) ?>" class="btn btn-small btn-light  <?= $isButtonEnabled ? '' : 'disabled' ?>" 
<?php if (!$isButtonEnabled) echo 'onclick="return false;" style="pointer-events: none; opacity: 0.5;"'; ?>>
    <i class="fa-solid fa-file-signature"></i>
</a>

</td>
    </tr>  
   <?php }?>
  </tbody>
</table>

</div>



</body>
</html>

  
      