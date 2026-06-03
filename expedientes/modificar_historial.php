<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #e0f7f9;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        #barra {
            width: 100%;
            height: 70px;
            background-color: #343a40;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }
        #calendario h1 {
            color: white;
            font-size: 24px;
            margin: 0;
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
            background-color: #61a4a4;
        }
        #borde {
            background-color: #FFFFFF;
            max-width: 500px;
            padding: 40px;
            margin: 30px auto;
            border-radius: 15px;
            box-shadow: 0px 7px 15px rgba(0, 0, 0, 0.1);
            animation: fadeFloatUp 1s ease-out forwards;
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
        .btn-warning {
            font-size: 1rem;
            padding: 10px 15px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
<?php
    include "../modelo/conexion.php";
    if (isset($_GET['no_cita'])) {
        $no_cita = $_GET['no_cita'];
    }
$no_expediente = $_GET['no_expediente'];
$id_paciente = $_GET['id_paciente'];
$sql_regreso = $conexion->query("SELECT * FROM paciente WHERE id_paciente = '$id_paciente'");
  $regreso = $sql_regreso->fetch_object();
  $pnom_paciente = $regreso->pnom_paciente;
  $snom_paciente=$regreso->snom_paciente;
  $apellidopa_paciente=$regreso->apellidopa_paciente;
  $apellidoma_paciente = $regreso->apellidoma_paciente;
?>

<div id="barra">
        <div id="calendario">
            <h1>Modificar historial Clínico</h1>
        </div>
        <a href="./index.php?id_paciente=<?=$id_paciente?>&pnom_paciente=<?=$pnom_paciente?>&snom_paciente=<?=$snom_paciente?>&apellidopa_paciente=<?=$apellidopa_paciente?>&apellidoma_paciente=<?=$apellidoma_paciente?><?php echo isset($no_cita) ? '&no_cita=' . $no_cita : ''; ?>" id="back">Regresar</a>
    </div>
<div id="borde">
<form  method="POST" > 
    <?php
    include "../modelo/conexion.php";
    include "../controlador/modificar_historial.php";
    ?>
<p>Oclusión:</p>
    <label><input type="checkbox" name="oclusion[]" value="Mordida"> Mordida</label><br>
    <label><input type="checkbox" name="oclusion[]" value="Desgaste"> Oclusion</label><br>
    <label><input type="checkbox" name="oclusion[]" value="Intercuspideo"> Intercuspideo</label><br>
    <label><input type="checkbox" name="oclusion[]" value="Onoclusión"> Onoclusión</label><br>
    <label><input type="checkbox" name="oclusion[]" value="Intercuspideo"> Ninguna</label><br><br>
<p>Enfermedades personales:</p>
    <label><input type="checkbox" name="enfermedades[]" value="Aparato cardiovascular"> Aparato cardiovascular</label><br>
    <label><input type="checkbox" name="enfermedades[]" value="Sistema nervioso"> Sistema nervioso</label><br>
    <label><input type="checkbox" name="enfermedades[]" value="Aparato resporatorio"> Aparato resporatorio</label><br>
    <label><input type="checkbox" name="enfermedades[]" value="Propension hemorragica"> Propension hemorragica</label><br>
    <label><input type="checkbox" name="enfermedades[]" value="Renal"> Renal</label><br>
    <label><input type="checkbox" name="enfermedades[]" value="Aparato digestivo"> Aparato digestivo</label><br>
    <label><input type="checkbox" name="enfermedades[]" value="Diabetes"> Diabetes</label><br>
    <label><input type="checkbox" name="enfermedades[]" value="Artritis"> Artritis</label><br>
    <label><input type="checkbox" name="oclusion[]" value="Intercuspideo"> Ninguna</label><br><br>
<p>Hábitos:</p>
    <label><input type="checkbox" name="habitos[]" value="Bricomania"> Bricomanía</label><br>
    <label><input type="checkbox" name="habitos[]" value="Contracciones musculares"> Contracciones musculares</label><br>
    <label><input type="checkbox" name="habitos[]" value="Hábitos de mordida"> Hábitos de mordida</label><br>
    <label><input type="checkbox" name="habitos[]" value="Respiración bucal"> Respiración bucal</label><br>
    <label><input type="checkbox" name="habitos[]" value="Labios"> Labios</label><br>
    <label><input type="checkbox" name="habitos[]" value="Lengua"> Lengua</label><br>
    <label><input type="checkbox" name="habitos[]" value="Dedos"> Dedos</label><br>
    <label><input type="checkbox" name="oclusion[]" value="Intercuspideo"> Ninguno</label><br><br>
<p>Otras condiciones:</p>
    <label><input type="checkbox" name="otras[]" value="Desmayos"> Desmayos</label><br>
    <label><input type="checkbox" name="otras[]" value="Vértigos"> Vértigos</label><br>
    <label><input type="checkbox" name="otras[]" value="Embarazo"> Embarazo</label><br>
    <label><input type="checkbox" name="otras[]" value="Mareos"> Mareos</label><br>
    <label><input type="checkbox" name="oclusion[]" value="Intercuspideo"> Ninguno</label><br><br>
    <button type="submit" name="enviar" value="ok">Enviar</button>
</form>        

</div>
</body>
</html>