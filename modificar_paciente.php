<?php
include "modelo/conexion.php";
$id = $_GET["id"];
$sql = $conexion->query("SELECT * FROM paciente WHERE id_paciente = $id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Afacad:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">

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
            width: 600px;
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
        <div id="calendario"><h1>Modificar paciente</h1></div>
        <div id="regresar">
            <a href="javascript:window.history.back();" id="back">Regresar</a>
        </div>
    </div><br>
<form class="col-4 m-auto" method="POST">
  <div id="borde">
    <input type="hidden" name="id" value="<?=$_GET["id"]?>">
   <?php 
   include "controlador/modificar_paciente.php";
   while ($datos = $sql->fetch_object()) { ?>
   <div class="mb-3">
    <label for="primerNombre" class="form-label">Primer nombre</label>
    <input type="text" class="form-control" id="primerNombre" name="primer-nombre" value="<?= $datos->pnom_paciente ?>">
  </div>
  <div class="mb-3">
    <label for="segundoNombre" class="form-label">Segundo nombre</label>
    <input type="text" class="form-control" id="segundoNombre" name="segundo-nombre" value="<?= $datos->snom_paciente ?>">
  </div>
  <div class="mb-3">
    <label for="apellidoPa" class="form-label">Apellido paterno</label>
    <input type="text" class="form-control" id="apellidoPa" name="apellido-pa" value="<?= $datos->apellidopa_paciente ?>">
  </div>
  <div class="mb-3">
    <label for="apellidoMa" class="form-label">Apellido materno</label>
    <input type="text" class="form-control" id="apellidoMa" name="apellido-ma" value="<?= $datos->apellidoma_paciente ?>">
  </div>
  <div class="mb-3">
    <label for="fechaNa" class="form-label">Fecha de nacimiento</label>
    <input type="date" class="form-control" id="fechaNa" name="fecha-na" value="<?= $datos->fecha_nacimiento_p ?>">
  </div>
  <div class="mb-3">
    <label for="correo" class="form-label">Correo electrónico</label>
    <input type="email" class="form-control" id="correo" name="correo" value="<?= $datos->correo_paciente ?>">
  </div>
  <div class="mb-3">
    <label for="telefono" class="form-label">Teléfono</label>
    <input type="text" class="form-control" id="telefono" name="telefono" value="<?= $datos->tel_paciente ?>">
  </div><br>
  <?php } ?>
  
  <!-- Botones de acción -->
  <div class="d-flex justify-content-between">
    <!-- Botón para modificar paciente -->
    <button href="http://localhost/login/home.php" type="submit" class="btn btn-primary" name="registrar" value="ok">Modificar paciente</button>
    
    <!-- Botón para regresar -->
    <a href="./home.php" class="btn btn-secondary">Regresar</a>
  </div>
  </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
