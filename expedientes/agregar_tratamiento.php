<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Tratamiento</title>
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
            justify-content: center;
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
            width:900px;
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
        <div id="calendario"><h1>Reporte de cita</h1></div>
        <div id="regresar">
            <a href="javascript:window.history.back();" id="back">Regresar</a>
        </div>
    </div>
    <div id="borde">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        
    <?php
    $no_seguimiento= $_GET['no_seguimiento'];
    $nom_seguimiento=$_GET['nom_seguimiento'];
    $no_cita = $_GET['no_cita'];
    $id_paciente = $_GET['id_paciente'];
    $evaluar_esta_cita = $_GET['evaluar'];

    include "../modelo/conexion.php";
    $sql1 = $conexion->query("SELECT fecha_cita, motivo_cita FROM cita WHERE no_cita = '$no_cita'");
    $datos1 = $sql1->fetch_object();
    $fecha_cita = $datos1->fecha_cita;
    $fecha_convertida = date("d-m-Y", strtotime($fecha_cita));
    $motivo_cita = $datos1->motivo_cita;
    
    $sql = $conexion->query("SELECT pnom_paciente, apellidopa_paciente FROM paciente WHERE id_paciente = '$id_paciente'");
    $datos = $sql->fetch_object();
    $pnom_paciente = $datos->pnom_paciente;
    $apellidopa_paciente = $datos->apellidopa_paciente;
    ?>
        <h3 class="text-center text-dark">Reporte cita del <?=$fecha_convertida?> <br> </h3>
        <h5 class="text-center text-secondary">Paciente: <?=$pnom_paciente?> <?=$apellidopa_paciente?></h5>
        <h5 class="text-center text-secondary">Motivo de cita: <?=$motivo_cita?></h5>
   
    <div class="container my-4">
        <div class="card" style="background-color: #cce5ff; border: none; border-radius: 15px; width: 643px; margin: auto;">
            <div class="card-body text-center">
            <h5 class="card-title">Valorar en esta cita</h5>
            <p class="card-text">
                <strong><?=$evaluar_esta_cita?></strong>
            </p>
            </div>
        </div>
    </div>

<form class="col-9 p-3 m-auto" method="POST">
  <div class="mb-3">
    <label for="observaciones" class="form-label">Observaciones:</label>
    <textarea id="observaciones" name="observaciones" rows="2" cols="50" class="form-control"></textarea>
  </div>

   <div class="mb-3">
    <label for="diagnostico" class="form-label">Diagnóstico:</label>
    <textarea id="diagnostico" name="diagnostico" rows="2" cols="50" class="form-control"></textarea>
  </div>

  <div class="mb-3">
    <label for="medicamentos" class="form-label">Medicamentos recetados:</label>
    <textarea id="medicamentos" name="medicamentos" rows="2" cols="50" class="form-control"></textarea>
  </div>

  <div class="mb-3">
    <label for="evaluar" class="form-label">Puntos a evaluar próxima cita:</label>
    <textarea id="evaluar" name="evaluar" rows="2" cols="50" class="form-control"></textarea>
  </div>

  <div class="mb-3">
    <label for="total" class="form-label">Total ($):</label>
    <input type="text" class="form-control w-50  mx-auto d-block" id="total" name="total">
  </div>

  <?php
    include "../modelo/conexion.php";
    include "../controlador/agregar_tratamiento.php";
    ?>

  <button type="submit" class="btn btn-primary" name="crear_tratamiento" value="ok">Crear reporte</button>
</form>

</body>
</html>
