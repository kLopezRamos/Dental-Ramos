<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial Clínico</title>
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
<body><?php
        include "../modelo/conexion.php";
        if (isset($_GET['no_cita'])) {
            $no_cita = $_GET['no_cita'];
        }
  $id_paciente = $_GET['id'];
  $sql_regreso = $conexion->query("SELECT * FROM paciente WHERE id_paciente = '$id_paciente'");
  $regreso = $sql_regreso->fetch_object();
  $pnom_paciente = $regreso->pnom_paciente;
  $snom_paciente=$regreso->snom_paciente;
  $apellidopa_paciente=$regreso->apellidopa_paciente;
  $apellidoma_paciente = $regreso->apellidoma_paciente;

?>
    <div id="barra">
        <div id="calendario">
            <h1>Historial Clínico</h1>
        </div>
        <a href="./index.php?id_paciente=<?=$id_paciente?>&pnom_paciente=<?=$pnom_paciente?>&snom_paciente=<?=$snom_paciente?>&apellidopa_paciente=<?=$apellidopa_paciente?>&apellidoma_paciente=<?=$apellidoma_paciente?><?php echo isset($no_cita) ? '&no_cita=' . $no_cita : ''; ?>" id="back">Regresar</a>
    </div>
    <div id="borde">
        <h2>Historial Clínico</h2>
        <?php
        // Recibe las variables mediante la URL
      

        include "../modelo/conexion.php";
        function llenado_de_historial($no_expediente, $conexion, $id_paciente){
            $sql4 = $conexion->query("SELECT enferm_hist, tejidos_oclusion_hist, otras_condiciones, habitos_hist FROM historial_clinico WHERE no_expediente = '$no_expediente'");
            while ($row = $sql4->fetch_assoc()) {
                $allColumnsHaveValue = true;
                foreach ($row as $column => $value) {
                    if (empty($value)) {
                        $allColumnsHaveValue = false;
                        break;
                    }
                }
                if ($allColumnsHaveValue) {
                    $sql_prueba = $conexion->query("SELECT enferm_hist, tejidos_oclusion_hist, otras_condiciones, habitos_hist FROM historial_clinico WHERE no_expediente = '$no_expediente'");
                    if ($sql_prueba->num_rows > 0) {
                        $datos = $sql_prueba->fetch_object();
                        echo "<p><strong>Enfermedades:</strong> " . $datos->enferm_hist . "</p>";
                        echo "<p><strong>Oclusión:</strong> " . $datos->tejidos_oclusion_hist . "</p>";
                        echo "<p><strong>Otras condiciones:</strong> " . $datos->otras_condiciones . "</p>";
                        echo "<p><strong>Hábitos:</strong> " . $datos->habitos_hist . "</p>";
                        if (isset($_GET['no_cita'])) {
                            $no_cita = $_GET['no_cita'];
                        }
                        $href = 'modificar_historial.php?no_expediente=' . $no_expediente . '&id_paciente=' . $id_paciente;

                        if (isset($no_cita)) {
                            $href .= '&no_cita=' . $no_cita;
                        }
                        
                        echo '<a href="' . $href . '" class="btn btn-small btn-warning"><i class="fa-regular fa-pen-to-square"></i> Modificar</a>';
                                        } else {
                        echo "<p>No se encontraron resultados.</p>";
                    }
                } else {
                    include "datos_llenado_historial.php";
                }
            }
        }
        if (isset($id_paciente)) {
            $sql = $conexion->query("SELECT no_expediente FROM expediente WHERE id_paciente = '$id_paciente'");
            if ($sql->num_rows > 0) {
                $datos_expediente = $sql->fetch_object();
                $no_expediente = $datos_expediente->no_expediente;
                $sql_verificacion = $conexion->query("SELECT * FROM historial_clinico WHERE no_expediente = '$no_expediente'");
                if ($sql_verificacion->num_rows == 0) {
                    $sql2 = $conexion->query("INSERT INTO historial_clinico(no_expediente) VALUES ('$no_expediente')");
                    if ($sql2) {
                        $no_historial = $conexion->insert_id;
                        $sql3 = $conexion->query("UPDATE expediente SET no_historial = '$no_historial' WHERE no_expediente = '$no_expediente'");
                        if ($sql3) {
                            echo '<p>Historial clínico creado y expediente actualizado correctamente.</p>';
                            llenado_de_historial($no_expediente, $conexion, $id_paciente);
                        } else {
                            echo '<p>Error al actualizar el expediente con el historial.</p>';
                        }
                    } else {
                        echo '<p>Error al crear el historial clínico.</p>';
                    }
                } else {
                    llenado_de_historial($no_expediente, $conexion, $id_paciente);
                }
            } else {
                echo '<p>No se encontró el expediente para este paciente.</p>';
            }
        } else {
            echo '<p>No se recibió el ID del paciente.</p>';
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
