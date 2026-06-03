<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

        /* Animación de aparecer flotando hacia arriba */
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
        <div id="calendario"><h1>Registro</h1></div>
        <div id="regresar"><a href="calendario_cita/calendario.php" id="back">Regresar</a></div>
    </div>

    <form class="col-4 m-auto" method="POST">
        <h3 class="text-center text-secondary"></h3>
        <?php
         $id_empleado= $_GET['id'];
          $fecha_cita= $_GET['fecha'];
          $hora_cita=$_GET['hora'];
       
        include "modelo/conexion.php";
        include "controlador/registro_paciente.php"
        ?>
        <div style="<?php if($sql_expediente === TRUE) { echo 'display: none;'; } ?>" id="borde">
          <h1 class="text-center p-3">Registro de paciente</h1>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Primer nombre</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="primer-nombre">
            <div id="emailHelp" class="form-text">Los datos recopilados se guardarán en la base de datos</div>
          </div><br>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Segundo nombre</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="segundo-nombre">
          </div><br>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Apellido paterno</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="apellido-pa">
          </div><br>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Apellido materno</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="apellido-ma">
          </div><br>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label" placeholder="Escribe tu nombre">Fecha de nacimiento</label>
            <input type="date" class="form-control" id="exampleInputPassword1" name="fecha-na">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Edad</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="edad_paciente">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Correo electrónico</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="correo">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="telefono">
          </div>

          <button type="submit" class="btn btn-primary" name="registrar" value="ok">Registrar</button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
