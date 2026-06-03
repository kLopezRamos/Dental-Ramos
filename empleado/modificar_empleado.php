<?php
include "../modelo/conexion.php";
$id=$_GET["id"];
$sql=$conexion->query("select * from empleado where id_empleado=$id");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <div id="calendario"><h1>Modificar empleado</h1></div>
        <div id="regresar"><a href="../empleado/ver_empleados.php" id="back">Regresar</a></div>
    </div><br>
<form class="col-4 m-auto" m method="POST">
  <div id="borde">
    <input type="hidden" name="id" value="<?=$_GET["id"]?>">
   <?php 
   include "../controlador/empleado/modificar_empleado.php";
   while($datos=$sql->fetch_object()){?>
   <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Primer nombre</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="primer-nombre" value="<?= $datos->pnom_empleado?>">
    <div id="emailHelp" class="form-text">Los datos recopilados se guardarán en la base de datos</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Segundo nombre</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="segundo-nombre" value="<?= $datos->snom_empleado?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Apellido paterno</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="apellido-pa" value="<?= $datos->apellidopa_empleado?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Apellido materno</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="apellido-ma" value="<?= $datos->apellidoma_empleado?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Fecha de nacimiento</label>
    <input type="date" class="form-control" id="exampleInputPassword1" name="fecha-na" value="<?= $datos->fecha_nacimiento_emp?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Edad</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="edad" value="<?= $datos->edad_empleado?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Ocupacion</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="ocupacion" value="<?= $datos->ocupacion_empleado?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Correo</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="correo" value="<?= $datos->correo?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Teléfono</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="telefono" value="<?= $datos->telefono_empleado?>">
  </div>

  
  <label for="empleado">Rol</label> <br>
   <select id="empleado" class="form-control" name="rol">
       <option value="">Seleccionar...</option> 
       <option value="user">Usuario</option>
       <option value="admin">Administrador</option>
   </select>
<br>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Usuario</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="usuario" value="<?= $datos->usuario?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Contraseña</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="contrasena" value="<?= $datos->contrasena?>">
  </div>
<?php
   }
   ?>
  
 
  <button type="submit" class="btn btn-primary" name="registrar" value="ok">Modificar empleado</button>
  </div>
</form>
</body>
</html>