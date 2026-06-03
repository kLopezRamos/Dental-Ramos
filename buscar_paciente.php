<?php


include "modelo/conexion.php";
include "controlador/eliminar_paciente.php";
$pacienteEliminado = false;

if (isset($_GET['id'])) {
    $idPaciente = $_GET['id'];
    // Aquí se puede ejecutar la función que elimina el paciente
    $eliminar = $conexion->query("DELETE FROM paciente WHERE id_paciente = $idPaciente");
    
    if ($eliminar) {
        $pacienteEliminado = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes Registrados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    
    <h1 class="text-center p-3">Pacientes registrados</h1>

    <!--alerta-->
    <?php if ($pacienteEliminado): ?>
        <div id="alertaEliminado" class="alert alert-success alert-dismissible fade show" role="alert">
            Paciente eliminado exitosamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <script>
            setTimeout(function() {
                let alerta = document.getElementById('alertaEliminado');
                if (alerta) {
                    alerta.classList.remove('show');
                    alerta.classList.add('fade');
                }
            }, 10000);
        </script>
    <?php endif; ?>

    <div class="container-fluid">
        <!-- Formulario de búsqueda -->
        <div class="row mb-3">
            <form class="col-12 p-3" method="POST">
                <h5 class="text-center text-secondary">Buscar paciente</h5>
                <div class="mb-3">
                    <label for="buscarPaciente" class="form-label">Ingresar primer nombre o apellido</label>
                    <input type="text" class="form-control" id="buscarPaciente" name="buscar" placeholder="Nombre o apellido">
                </div>
                <button type="submit" class="btn btn-primary" name="registrar" value="ok">Buscar</button>
            </form>
        </div>
        
        <!-- Tabla de pacientes -->
        <div class="row">
            <div class="col-12 p-3">
                <h5 class="text-center text-secondary">Pacientes existentes</h5>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col"></th>
                        <th scope="col"></th>
                            <th scope="col">ID</th>
                            <th scope="col">Primer nombre</th>
                            <th scope="col">Segundo nombre</th>
                            <th scope="col">Apellido P</th>
                            <th scope="col">Apellido M</th>
                            
                            <th scope="col">Fecha nacimiento</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Ver citas</th>
                            <th scope="col">Agendar cita </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $buscar = "";
                        if (isset($_POST['buscar'])) {
                            $buscar = $_POST['buscar'];
                        }
                        $sql = $conexion->query("SELECT * FROM paciente WHERE pnom_paciente LIKE '%$buscar%' OR apellidopa_paciente LIKE '%$buscar%' ORDER BY id_paciente DESC");

                        while($datos=$sql->fetch_object()){
                            $fecha_convertida = date("d/m/Y", strtotime($datos->fecha_nacimiento_p));
                            ?>
                                <tr>
                                <td>
                                    <a href="javascript:void(0);" 
                                       onclick="confirmarEliminacion('<?= $datos->id_paciente ?>')" 
                                       class="btn btn-small btn-danger">
                                       <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </td>
                                <td>
                              <a href="modificar_paciente.php?id=<?=$datos->id_paciente?>" class="btn btn-small btn-warning"><i class="fa-regular fa-pen-to-square"></i></a>
                            </td>
                                <th scope="row"><?= $datos->id_paciente ?></th>
                                <td><?= $datos->pnom_paciente ?></td>
                                <td><?= $datos->snom_paciente ?></td>
                                <td><?= $datos->apellidopa_paciente ?></td>
                                <td><?= $datos->apellidoma_paciente ?></td>
                                <td><?= $fecha_convertida ?></td>
                                <td><?= $datos->correo_paciente ?></td>
                                <td><?= $datos->tel_paciente ?></td>
                                <td>
                                <a href="expedientes/ver_citas_paciente.php?id_paciente=<?=$datos->id_paciente?>&pnom_paciente=<?=$datos->pnom_paciente?>&apellidopa_paciente=<?=$datos->apellidopa_paciente?>" class="btn btn-small btn-primary  "><i class="fa-solid fa-calendar-check"></i></a>
                                </td>
                                <td>
                                             <!--CAMBIO DE SESION-->

                                <a href="calendario_cita/calendario.php?id_paciente=<?=$datos->id_paciente?>" class="btn btn-small btn-primary"><i class="fa-regular fa-calendar-plus"></i></a>
                                </td>
                                
                            </tr>  
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function confirmarEliminacion(idPaciente) {
            if (confirm("¿Estás seguro de que deseas eliminar a este paciente?")) {
                window.location.href = 'home.php?id=' + idPaciente;
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>