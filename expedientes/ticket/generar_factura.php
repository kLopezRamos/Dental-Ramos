<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Generar Factura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Afacad:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <style>
    .custom-border {
        border: 2px solid #3178bf ; /* Cambia #ff5733 por el color que prefieras */
        box-shadow: none; /* Opcional: elimina el shadow predeterminado de Bootstrap */
    }
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

        
        @keyframes fadeFloatUp {
            0% {
                transform: translateY(20px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        #borde {
            background-color: #FFFFFF;
            width: 900px;
            padding: 65px;
            text-align: center;
            margin: 20px auto;
            border-radius: 15px;
            box-shadow: #5f5e5e 0px 7px 8px;
            animation: fadeFloatUp 1s ease-out forwards;
        }
        </style>
</head>
<body>
<div id="barra">
        <div id="calendario"><h1>Factura</h1></div>
        <div id="regresar">
            <a href="javascript:window.history.back();" id="back">Regresar</a>
        </div>
    </div><br>
    <div id="borde">
<?php

$no_tratamiento = $_GET['no_tratamiento'];
$id_paciente = $_GET['id_paciente'];
$diagnostico = $_GET['diagnostico'];
$total = $_GET['total'];
$metodo_pago = $_GET['metodo_pago'];
$no_seguimiento = $_GET['no_seguimiento'];
$nom_Seguimiento = $_GET['nombre_seguimiento'];
//CAMBIO SOLAMENTE DEFINIR NO_cITA EN CASO DE QUEESTA VARIABLE ESTE DEFINIDA
if (isset($_GET['no_cita'])) {
  $no_cita = $_GET['no_cita'];
}
//$no_cita = $_GET['no_cita'];
$fecha_convertida = $_GET['fecha_convertida'];





   include "../../modelo/conexion.php";
   $sql_ticket=$conexion->query("SELECT id_ticket FROM ticket WHERE no_tratamiento = '$no_tratamiento'");
   $datos_ticket=$sql_ticket->fetch_object();
   $id_ticket=$datos_ticket->id_ticket;

   $sql_paciente=$conexion->query("SELECT * FROM paciente WHERE id_paciente='$id_paciente'");
   $datos_paciente=$sql_paciente->fetch_object();
   //CAMBIO DE RFC
   $sql_factura_existente=$conexion->query("SELECT * FROM factura WHERE id_ticket='$id_ticket'");
   $datos_factura=$sql_factura_existente->fetch_object();
   if ($sql_factura_existente->num_rows > 0) {
    $rfc_paciente=$datos_factura->rfc_paciente;
   }
   
   ?>
<h1 class="text-center p-3">Generar factura</h1>

<form class="col-7 m-auto" method="POST" >
<?php
  include "controlador_factura.php";
  ?>


    <h3 class="text-center text-secondary"></h3>
<div>
    <input type="hidden" class="form-control" aria-describedby="emailHelp" name="id_ticket" value="<?=$id_ticket?>">
   
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Primer nombre</label>
    <input type="text" class="form-control" aria-describedby="emailHelp" name="primer-nombre" value="<?=$datos_paciente->pnom_paciente?>">
    <div id="emailHelp" class="form-text">Los datos recopilados se guardarán en la base de datos</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Segundo nombre</label>
    <input type="text" class="form-control"  name="segundo-nombre" value="<?=$datos_paciente->snom_paciente?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Apellido paterno</label>
    <input type="text" class="form-control"  name="apellido-pa" value="<?=$datos_paciente->apellidopa_paciente?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Apellido materno</label>
    <input type="text" class="form-control"  name="apellido-ma" value="<?=$datos_paciente->apellidoma_paciente?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Descripcion del servicio</label>
    <textarea id="comentarios" name="diagnostico" rows="4" cols="50" class="form-control" ><?=$diagnostico?></textarea>
    <div id="emailHelp" class="form-text"></div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label" placeholder="Escribe tu nombre">Fecha de relización de tratamiento</label>
    <input type="text" class="form-control"  name="fecha_convertida"  value="<?=$fecha_convertida?>">
  </div>
  <!--   //CAMBIO DE RFC-->
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label" placeholder="Escribe tu nombre">RFC del paciente</label>
    <input type="text" class="form-control  custom-border"  name="rfc_paciente" value="<?php echo isset($rfc_paciente) ? $rfc_paciente : ''; ?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Nombre de establecimiento</label>
    <input type="text" class="form-control"  name="nombre_consultorio" value="Consultorio Dental Ramos"> 
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">RFC de establecimiento</label>
    <input type="text" class="form-control"  name="rfc_consultorio" value="COS100326H78">
  </div>
 
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Total</label>
    <input type="text" class="form-control"  name="total" value="<?=$total?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Método de pago</label>
    <input type="text" class="form-control  "  name="metodo_pago" value="<?=$metodo_pago?>">
  </div>
 
  <button type="submit" class="btn btn-primary" name="generar" value="ok" >Enviar factura</button>
 
</div>
</div>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>