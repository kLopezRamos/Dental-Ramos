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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas Pacientes</title>
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
            width: 1200px;
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
$id_paciente = $_GET['id_paciente'];
$pnom_paciente = $_GET['pnom_paciente'];
$apellidopa_paciente = $_GET['apellidopa_paciente'];
?> 

        
   
   <div class="container-fluid row " >
   <div id="barra">
        <div id="calendario"><h1>Citas del paciente</h1></div>
        <div id="regresar"><a href="../home.php" id="back">Regresar</a></div>
    </div><br>
    <div id="borde">
   <form class="col-4 p-3 m-auto" method="POST">
 <div class="mb-3 ">
 <?php
  include "../modelo/conexion.php";

   $sql = $conexion->query("SELECT id_empleado, pnom_empleado, apellidopa_empleado, apellidoma_empleado FROM empleado WHERE ocupacion_empleado != 'Recepcionista' "); 
   $empleados = $sql->fetch_all(MYSQLI_ASSOC);
 ?>
 <h3 class="text-center text-dark">Citas agendadas para <br></h3>
 <h5 class="text-center text-secondary"><?=$pnom_paciente?> <?=$apellidopa_paciente?></h5>
 <br>
 
   <input type="hidden" class="form-control" name="id_paciente" value="<?=$id_paciente?>">
   
   <label for="empleado">Con el doctor(a):</label> <br>
   <select id="empleado" class="form-control" name="id_empleado">
       <option value="">Seleccionar...</option> 
       <?php foreach ($empleados as $empleado): ?>
           <option value="<?php echo $empleado['id_empleado']; ?>">
               <?php echo $empleado['pnom_empleado']. ' '.$empleado['apellidopa_empleado']. ' '.$empleado['apellidoma_empleado'] ?>
           </option>
       <?php endforeach; ?>
   </select>
   
</div>

 <button type="submit" class="btn btn-primary " name="buscar" value="ok">Buscar</button>
</form>



<div class="col-10 p-3 m-auto">
    
<table class="table">
<h5 class="text-center text-secondary">Citas agendadas</h5>
  <thead>
    <tr>
    <th scope="col">Fecha</th> 
    <th scope="col">Hora</th>
    <th scope="col">Nombre Dcotor</th>  
    <th scope="col">Apellido Paterno</th>
    <th scope="col">Nombre Paciente</th>
      <th scope="col">Apellido Paterno</th>
      <th scope="col">Apellido Materno</th>
      <th scope="col">Edad</th>
      <th scope="col">Motivo</th>
      <th scope="col">Modificar Expediente</th>
     
    </tr>
  </thead>
  <tbody>
    <?php
    include "../modelo/conexion.php";
  
$buscar = ""; // Inicializamos la variable para evitar el error al carga la pagina por primera vez, aqui esoty diciendo que el valor sea un acadena vacia en un inicio
if (isset($_POST['buscar']) ) { //isset verifica que se haya enviado el valor ''buscar' (que es en name en) mediante el formulario, es decir que 'buscar' tenga valor
    $id_paciente = $_POST['id_paciente'];
    $id_empleado = $_POST['id_empleado'];

}
if(!empty($id_empleado)&&!empty($id_paciente)){
    $sql = $conexion->query("SELECT
      a.fecha_cita,
      c.pnom_empleado,
      c.snom_empleado,
      b.id_paciente,
      b.pnom_paciente,
      b.snom_paciente,
      b.apellidopa_paciente,
      b.apellidoma_paciente,
      b.edad_paciente,
      a.motivo_cita,
      a.no_cita,
      a.hora_cita
    
      FROM cita a 
      LEFT JOIN paciente b ON a.id_paciente = b.id_paciente
      LEFT JOIN empleado c ON a.id_empleado = c.id_empleado
      WHERE a.id_empleado = '$id_empleado' 
      AND b.id_paciente = '$id_paciente' 
      ORDER BY a.fecha_cita ASC, a.hora_cita ASC");
    
    while($datos = $sql->fetch_object()){
        $fecha_convertida = date("d/m/Y", strtotime($datos->fecha_cita));

        ?>
        <tr>
            <td class="d-none"><?= $datos->no_cita ?></td>
            <th scope="row"><?= $fecha_convertida ?></th>
            <td><?= $datos->hora_cita ?></td>
            <td><?= $datos->pnom_empleado ?></td>
            <td><?= $datos->snom_empleado ?></td>
            <td><?= $datos->pnom_paciente ?></td>
            <td><?= $datos->apellidopa_paciente ?></td>
            <td><?= $datos->apellidoma_paciente ?></td>
            <td><?= $datos->edad_paciente ?></td>
            <td><?= $datos->motivo_cita ?></td>
       
            <td>
    <!--CAMBIO QUITE MOTIVO_CITA DE LA URL-->
            <a href="index.php?id_paciente=<?=$datos->id_paciente?>&pnom_paciente=<?=$datos->pnom_paciente?>&snom_paciente=<?=$datos->snom_paciente?>&apellidopa_paciente=<?=$datos->apellidopa_paciente?>&apellidoma_paciente=<?=$datos->apellidoma_paciente?>&no_cita=<?=$datos->no_cita?>" class="btn btn-small btn-primary <?php echo $isUser ? 'disabled' : '';?>"><i class="fa-solid fa-folder"></i></a>
            </td>
        </tr> 
      
        <?php
    }
    
}

/*
     <th scope="col">Nombre Paciente</th>
      <th scope="col">Apellido Paciente</th>
      <th scope="col">Edad</th>

<td><?= $datos->$datos->pnom_paciente ?></td>
<td><?= $datos->apellidopa_paciente ?></td>
<td><?= $datos->edad_paciente ?></td> 

   */
   ?>
  
  </tbody>
</table>
</div>
    </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>