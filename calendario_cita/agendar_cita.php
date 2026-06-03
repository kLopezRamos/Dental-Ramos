
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Cita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        h1 {
            color: #343a40;
            font-size: 2.5rem;
            margin-bottom: 30px;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 8px;
            padding: 10px 20px;
            margin: 10px;
            text-transform: uppercase;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .alert {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <?php
        if(isset($_SESSION['status'])){
            ?>
            <div class="alert alert-success"><?php echo $_SESSION['status'];?></div>
            <?php
            unset($_SESSION['status']);
        }
        ?>
         <!--CAMBIO DE SESION-->
        <h1 class="text-center">Agendar Cita</h1>
        <div class="d-flex justify-content-center">
            <a href="calendario_cita/calendario.php" class="btn btn-custom ">Paciente Nuevo</a>
            <a href="home.php" class="btn btn-custom ">Paciente Existente</a>
            <a href="calendario_cita/filtrar_cita.php" class="btn btn-custom">Filtrar Cita</a>
            <a href="calendario_cita/todas_citas.php" class="btn btn-custom">Citas próximas</a>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> 

</body>
</html>