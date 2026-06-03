<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expediente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            width: 700px;
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
    <?php
         //CAMBIO SOLAMENTE DEFINIR VARIABLE SI ESTA PRESENTE EN LA URL

      if (isset($_GET['no_cita'])) {
        $no_cita = $_GET['no_cita'];
    }
    ?>
    <div id="barra">
        <div id="calendario"><h1>Expediente</h1></div>
        <div id="regresar">
            
            <?php
            if (isset($no_cita)) {?>
                <a href="../calendario_cita/filtrar_cita.php" id="back">Regresar</a>
            <?php
            }else{
            ?>
                <a href="../mostrar_expedientes/mostrar_expedientes.php" id="back">Regresar</a>
            <?php
            }
            ?>
        </div>
    </div>
    <div id="borde">
    <h5>Datos personales:</h5>

    <?php
    include "../modelo/conexion.php";
    $id_paciente=$_GET["id_paciente"];
    $pnom_paciente=$_GET["pnom_paciente"];
    $snom_paciente=$_GET["snom_paciente"];
    $apellidopa_paciente=$_GET["apellidopa_paciente"];
    $apellidoma_paciente=$_GET["apellidoma_paciente"];
            
    /*CAMBIO SOLAMENTE DEFINIR VARIABLE SI ESTA PRESENTE EN LA URL

            if (isset($_GET['no_cita'])) {
                $no_cita = $_GET['no_cita'];
            }
            */
    
    echo 'Nombre completo: '.$pnom_paciente.' '. $snom_paciente.' '.$apellidopa_paciente.' '.$apellidoma_paciente;
    $sql = $conexion->query("SELECT *
      FROM paciente 
      WHERE id_paciente = '$id_paciente'
      ");
    $datos = $sql->fetch_object();
    $edad_paciente = $datos->edad_paciente;
    $fecha_nacimiento_p = $datos->fecha_nacimiento_p;
    $correo_paciente = $datos->correo_paciente;
    $tel_paciente = $datos->tel_paciente;
    ?>

    <br><br>

    <?php
    echo "<p>Fecha de nacimiento: $fecha_nacimiento_p</p> <p>Edad: $edad_paciente</p> <p>Correo: $correo_paciente</p> <p>Teléfono: $tel_paciente</p>";
    ?>

    <a href="../modificar_paciente.php?id=<?=$datos->id_paciente?>&ex=ex" class="btn btn-small btn-warning"><i class="fa-regular fa-pen-to-square"></i></a>
    <br><br>
    <!--CAMBIO-->

    <a class="btn btn-primary" href="historial_clinico.php?id=<?=$id_paciente?><?php echo isset($no_cita) ? '&no_cita=' . $no_cita : ''; ?>" role="button">Historial clinico</a>
  <!--CAMBIO-->
    <a class="btn btn-primary" href="seguimientos.php?id=<?=$datos->id_paciente?><?php echo isset($no_cita) ? '&no_cita=' . $no_cita : ''; ?>" role="button">Seguimientos</a>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>