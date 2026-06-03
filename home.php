<?php
session_start();

// Redirigir al login si el usuario no está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Verificar si el usuario es administrador
$isUser = isset($_SESSION['rol']) && $_SESSION['rol'] === 'user';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Dental</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style_home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Afacad:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar bg-dark d-flex flex-column justify-content-between p-3 text-white">
            <div>
                <div class="text-center mb-4">
                    <img src="img/dientelogo.png" id="diente" alt="Logo dental" class="img-fluid">
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item mb-3">
                        <a class="iconoletra" href="#" onclick="showSection('pacientesSection')">
                            <img src="img/personita.png" class="icono" id="persona">
                            Pacientes
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="iconoletra" href="#" onclick="showSection('citasSection')">
                            <img src="img/cita.png" class="icono">
                            Citas
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="iconoletra" href="mostrar_expedientes/mostrar_expedientes.php">
                            <img src="img/exp.png" class="icono" id="persona">
                            Expedientes
                        </a>
                    </li>
                    <?php if (!$isUser): ?>
                    <li class="nav-item mb-3">
                        <a class="iconoletra" href="empleado/ver_empleados.php">
                            <img src="img/emp.png" class="icono" id="persona">
                            Empleados
                        </a>
                    </li>
                <?php endif; ?>

                </ul>
            </div>
            <!-- Cerrar Sesión -->
            <div class="text-center mt-5">
                <a href="logout.php" id="cerrarsesion">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>
            </div>
        </div>

        <!-- Main -->
        <div class="content flex-grow-1 bg-light">
            <!-- Topbar -->
             <?php
             include "modelo/conexion.php";
             $nombre_usuario=$_SESSION['pnom_empleado'];
             $apellido_usuario=$_SESSION['apellidopa_empleado'];
             $rol_usuario = $_SESSION['rol'];
             ?>
            <nav class="navbar navbar-light bg-white border-bottom">
                <span class="navbar-text ml-auto">
                    <span class="badge badge-pill badge-secondary"><i class="fa-solid fa-user"></i> <?=$nombre_usuario?> <?=$apellido_usuario?> - <?=$rol_usuario?></span>
                </span>
            </nav>

            <!-- Content Area -->
            <div class="main-content p-4">
                <!-- Sección Pacientes -->
                <div class="section-content" id="pacientesSection" style="display: none;">
                    <h3 class="mb-3">Pacientes</h3>
                    <?php include 'buscar_paciente.php'; ?>
                </div>

                <!-- Sección Citas -->
                <div class="section-content" id="citasSection" style="display: none;">
                   <h3 class="mb-3">Citas</h3>
                   <div id="citasContent"></div>
                </div>

                <!-- Sección Expedientes -->
                <div class="section-content" id="expedientesSection" style="display: none;">
                    <h3 class="mb-3">Expedientes</h3>
                    <div id="expedientesContent"></div>
                </div>
            <?php //echo $isUser ? '' : 'disabled';
            
            ?>


                <!-- Sección Empleados -->
                <div class="section-content" id="empleadosSection" style="display: none;">

                    <h3 class="mb-3">Empleados</h3>
                    <div id="empleadosContent"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <script>
        function showSection(sectionId) {
            // Ocultar todas las secciones
            document.querySelectorAll('.section-content').forEach(section => {
                section.style.display = 'none';
            });

            // Mostrar la sección seleccionada
            document.getElementById(sectionId).style.display = 'block';

            // Cargar contenido específico para cada sección
            if (sectionId === 'citasSection') {
                loadCitasContent();
            } else if (sectionId === 'expedientesSection') {
                loadExpedientesContent();
            } else if (sectionId === 'empleadosSection') {
                loadEmpleadosContent();
            }
        }

        function loadCitasContent() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'calendario_cita/agendar_cita.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('citasContent').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }

        function loadExpedientesContent() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'mostrar_expedientes/mostrar_expedientes.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('expedientesContent').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }

        // Mostrar la primera sección al cargar la página
        showSection('pacientesSection');
    </script>
</body>
</html>
