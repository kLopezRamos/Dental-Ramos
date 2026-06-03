<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horarios Disponibles</title>
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
            width: 100px;
            height: 50px;
            border-radius: 25px;
            border: 3px solid;
            text-align: center;
            align-items: center;
            display: flex;
            padding-left: 50px;
        }

        #back:hover {
            background-color: rgb(97, 164, 164);
        }

        .icono {
            width: 35px;
            height: 35px;
        }

        .contenedor-intento1 {
            display: flex;
            justify-content: center;
            flex-wrap: wrap; /* Para que las tarjetas se alineen en filas */
            margin-top: 20px;
        }

        .intento1 {
            text-align: center;
            background-color: #c0dcf3;
            margin: 10px;
            display: inline-block;
            padding: 10px;
            border-radius: 10px;
        }

        .horario_d {
            width: 200px;
            border-radius: 10px;
            padding: 10px;
            margin: 5px;
            border: none;
            color: white;
            cursor: pointer;
        }

        .horario_d:hover {
            opacity: 0.5;
        }

        .disponible {
            background-color: #15d305;
        }

        .ocupado {
            background-color: #740404;
            cursor: not-allowed;
        }
    </style>
</head>
<body>

    <?php
        // Obtener el día, mes y año desde la URL
        $dia = isset($_GET['dia']) ? $_GET['dia'] : 'No disponible';
        $mes = isset($_GET['mes']) ? $_GET['mes'] : 'No disponible';
        $anio = isset($_GET['anio']) ? $_GET['anio'] : 'No disponible';
        echo $mes;

        $id_paciente = isset($_GET['id_paciente']) ? $_GET['id_paciente'] : null;
        
        if($dia < 10) {
            $dia = str_pad($dia, 2, '0', STR_PAD_LEFT);
        }
        if($mes < 10) {
            $mes = str_pad($mes, 2, '0', STR_PAD_LEFT);
        }
        $dia = strval($dia);
        $mes = strval($mes);
        $anio = strval($anio);
        // Mostrar la fecha seleccionada
        $fecha = "$anio-$mes-$dia";
        echo $mes;
     ?>
    <div id="barra">
        <div id="calendario"><h1><?="Horarios disponibles $dia/$mes/$anio"?></h1></div>
        <div id="regresar"><a href="../calendario_cita/calendario.php" id="back">Regresar</a></div>
    </div>

    <?php

    include "../modelo/conexion.php";
    function validarCita($fecha, $hora, $id_empleado, $conexion) {
        // Realizamos la consulta a la base de datos
        $validacion = $conexion->query("SELECT * FROM cita WHERE id_empleado = '$id_empleado' AND hora_cita = '$hora' AND fecha_cita = '$fecha'");
        
        // Si se encuentra algún registro, significa que ya hay una cita
        if ($validacion->num_rows > 0) {
            return 'ocupado';
        } else {
            return 'disponible';
        }
    }

     ?>
    <div class="contenedor-intento1">
    <?php
     include "../modelo/conexion.php";
     $sql = $conexion->query("SELECT * FROM empleado WHERE ocupacion_empleado != 'Recepcionista'");
     while($datos=$sql->fetch_object()){
        $id_empleado=$datos->id_empleado;
        ?> 
    <div class="intento1">
    <?="<p hidden>id: $id_empleado</p> <p> Doctor (a): $datos->pnom_empleado $datos->snom_empleado $datos->apellidopa_empleado $datos->apellidoma_empleado</p> <p>Ocupacion: $datos->ocupacion_empleado</p>"?>
    <div>
    <?php
        $horario_09 = validarCita($fecha, '09:00', $id_empleado, $conexion);
        if ($id_paciente !== null) {
        $href = $horario_09 == 'ocupado' ? '#' : "formulario_cita.php?id={$datos->id_empleado}&fecha={$fecha}&hora=09:00&id_paciente={$id_paciente}";
            ?>
        <a href="<?=$href?>"><button id="09:00" name="09:00" class="horario_d <?=$horario_09?>">09:00</button></a> 
        <?php
        }else{
            $href = $horario_09 == 'ocupado' ? '#' : "../index.php?id={$datos->id_empleado}&fecha={$fecha}&hora=09:00";
            ?>
            <a href="<?=$href?>"><button id="09:00" name="09:00" class="horario_d <?=$horario_09?>">09:00</button></a> 
            <?php   
        }
        ?>
    </div>
    <div>
    <?php
            $horario_10 = validarCita($fecha, '10:00', $id_empleado, $conexion);
            if ($id_paciente !== null) {
            $href = $horario_10 == 'ocupado' ? '#' : "formulario_cita.php?id={$datos->id_empleado}&fecha={$fecha}&hora=10:00&id_paciente={$id_paciente}";
                ?>
            
                <a href="<?=$href?>"><button id="10:00" name="10:00" class="horario_d <?=$horario_10?>">10:00</button></a> 
                <?php
            }else{
            $href = $horario_10 == 'ocupado' ? '#' : "../index.php?id={$datos->id_empleado}&fecha={$fecha}&hora=10:00";
                    ?>
                    <a href="<?=$href?>"><button id="10:00" name="10:00" class="horario_d <?=$horario_10?>">10:00</button></a> 
                    <?php   
                }
                    ?>
    </div>
    <div>
    <?php
            $horario_11 = validarCita($fecha, '11:00', $id_empleado, $conexion);
            if ($id_paciente !== null) {
            $href = $horario_11 == 'ocupado' ? '#' : "formulario_cita.php?id={$datos->id_empleado}&fecha={$fecha}&hora=11:00&id_paciente={$id_paciente}";
                ?>
                <a href="<?=$href?>"><button id="11:00" name="11:00" class="horario_d <?=$horario_11?>">11:00</button></a> 
                <?php
            }else{
            $href = $horario_11 == 'ocupado' ? '#' : "../index.php?id={$datos->id_empleado}&fecha={$fecha}&hora=11:00";
                    ?>
                <a href="<?=$href?>"><button id="11:00" name="11:00" class="horario_d <?=$horario_11?>">11:00</button></a> 
                <?php   
                }
                    ?>
    </div>
    <div>
    <?php
            $horario_12 = validarCita($fecha, '12:00', $id_empleado, $conexion);
            if ($id_paciente !== null) {
            $href = $horario_12 == 'ocupado' ? '#' : "formulario_cita.php?id={$datos->id_empleado}&fecha={$fecha}&hora=12:00&id_paciente={$id_paciente}";
                ?>
                <a href="<?=$href?>"><button id="12:00" name="12:00" class="horario_d <?=$horario_12?>">12:00</button></a> 
                <?php
            }else{
            $href = $horario_12 == 'ocupado' ? '#' : "../index.php?id={$datos->id_empleado}&fecha={$fecha}&hora=12:00";
                    ?>
            <a href="<?=$href?>"><button id="12:00" name="12:00" class="horario_d <?=$horario_12?>">12:00</button></a> 
            <?php   
                }
                    ?>
    </div>
    <div>
    <?php
            $horario_13 = validarCita($fecha, '13:00', $id_empleado, $conexion);
            if ($id_paciente !== null) {
            $href = $horario_13 == 'ocupado' ? '#' : "formulario_cita.php?id={$datos->id_empleado}&fecha={$fecha}&hora=13:00&id_paciente={$id_paciente}";
                ?>
                <a href="<?=$href?>"><button id="13:00" name="13:00" class="horario_d <?=$horario_13?>">13:00</button></a> 
                <?php
            }else{
            $href = $horario_13 == 'ocupado' ? '#' : "../index.php?id={$datos->id_empleado}&fecha={$fecha}&hora=13:00";
                    ?>
            <a href="<?=$href?>"><button id="13:00" name="13:00" class="horario_d <?=$horario_13?>">13:00</button></a> 
            <?php   
                }
                    ?>
    </div>
    <div>
    <?php
            $horario_14 = validarCita($fecha, '14:00', $id_empleado, $conexion);
            if ($id_paciente !== null) {
            $href = $horario_14 == 'ocupado' ? '#' : "formulario_cita.php?id={$datos->id_empleado}&fecha={$fecha}&hora=14:00&id_paciente={$id_paciente}";
                ?>
                <a href="<?=$href?>"><button id="14:00" name="14:00" class="horario_d <?=$horario_14?>">14:00</button></a> 
                <?php
            }else{
            $href = $horario_14 == 'ocupado' ? '#' : "../index.php?id={$datos->id_empleado}&fecha={$fecha}&hora=14:00";
                    ?>
            <a href="<?=$href?>"><button id="14:00" name="14:00" class="horario_d <?=$horario_14?>">14:00</button></a> 
            <?php   
                }
                    ?>
    </div>
    <div>
    <?php
            $horario_15 = validarCita($fecha, '15:00', $id_empleado, $conexion);
            if ($id_paciente !== null) {
            $href = $horario_15 == 'ocupado' ? '#' : "formulario_cita.php?id={$datos->id_empleado}&fecha={$fecha}&hora=15:00&id_paciente={$id_paciente}";
                ?>
                <a href="<?=$href?>"><button id="15:00" name="15:00" class="horario_d <?=$horario_15?>">15:00</button></a> 
                <?php
            }else{
            $href = $horario_15 == 'ocupado' ? '#' : "../index.php?id={$datos->id_empleado}&fecha={$fecha}&hora=15:00";
                    ?>
            <a href="<?=$href?>"><button id="15:00" name="15:00" class="horario_d <?=$horario_15?>">15:00</button></a> 
            <?php   
                }
                    ?>
    </div>
    <div>
    <?php
            $horario_16 = validarCita($fecha, '16:00', $id_empleado, $conexion);
            if ($id_paciente !== null) {
            $href = $horario_16 == 'ocupado' ? '#' : "formulario_cita.php?id={$datos->id_empleado}&fecha={$fecha}&hora=16:00&id_paciente={$id_paciente}";
                ?>
                <a href="<?=$href?>"><button id="16:00" name="16:00" class="horario_d <?=$horario_16?>">16:00</button></a> 
                <?php
            }else{
            $href = $horario_16 == 'ocupado' ? '#' : "../index.php?id={$datos->id_empleado}&fecha={$fecha}&hora=16:00";
                    ?>
            <a href="<?=$href?>"><button id="16:00" name="16:00" class="horario_d <?=$horario_16?>">16:00</button></a> 
            <?php   
                }
                    ?>
    </div>
    <div>
    <?php
            $horario_17 = validarCita($fecha, '17:00', $id_empleado, $conexion);
            if ($id_paciente !== null) {
            $href = $horario_17 == 'ocupado' ? '#' : "formulario_cita.php?id={$datos->id_empleado}&fecha={$fecha}&hora=17:00&id_paciente={$id_paciente}";
                ?>
                <a href="<?=$href?>"><button id="17:00" name="17:00" class="horario_d <?=$horario_17?>">17:00</button></a> 
                <?php
            }else{
            $href = $horario_17 == 'ocupado' ? '#' : "../index.php?id={$datos->id_empleado}&fecha={$fecha}&hora=17:00";
                    ?>
            <a href="<?=$href?>"><button id="17:00" name="17:00" class="horario_d <?=$horario_17?>">17:00</button></a> 
            <?php   
                }
                    ?>
    </div>
    </div>
    <?php } ?>
</body>
</html>
