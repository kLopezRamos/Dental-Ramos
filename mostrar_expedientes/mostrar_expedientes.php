<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expedientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        .icono{
            width: 35px;
            height: 35px;
          }
    </style>

</head>
<body>
    <div id="barra">
        <div id="calendario"><img src="../img/exp.png" class="icono"><h1>Expedientes</h1></div>
        <div id="regresar"><a href="../home.php" id="back">Regresar</a></div>
    </div>
    
    <?php
    include "../modelo/conexion.php";
    ?>
<div class="container-fluid" >
  
    <form class="col-4 p-3 m-auto" method="POST">
  <div class="mb-3 ">
  <h5 class="text-center text-secondary">Buscar paciente</h5>
    <label for="exampleInputEmail1" class="form-label">Ingresar primer nombre ó apellido</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="buscar">
    
</div>
 
  <button type="submit" class="btn btn-primary " name="registrar" value="ok">Buscar</button>
  
</form>

<div class="col-12  p-3 m-auto">
    
<table class="table">
<h5 class="text-center text-secondary">Pacientes existentes</h5>
  <thead>
    <tr>
   
      <th scope="col">ID</th>
      <th scope="col">Primer nombre</th>
      <th scope="col">Segundo nombre</th>
      <th scope="col">Apellido P</th>
      <th scope="col">Apellido M</th>
      <th scope="col">Fecha nacimiento</th>
      <th scope="col">Edad</th>
      <th scope="col">Correo</th>
      <th scope="col">Teléfono</th>
      <th scope="col">Expediente</th>
     
    </tr>
  </thead>
  <tbody>
    <?php
    include "../modelo/conexion.php";
  
$buscar = ""; // Inicializamos la variable para evitar el error al carga la pagina por primera vez, aqui esoty diciendo que el valor sea un acadena vacia en un inicio
if (isset($_POST['buscar'])) { //isset verifica que se haya enviado el valor ''buscar' (que es en name en) mediante el formulario, es decir que 'buscar' tenga valor
    $buscar = $_POST['buscar'];
}
    $sql = $conexion->query("SELECT * FROM paciente WHERE pnom_paciente LIKE '%$buscar%' OR apellidopa_paciente LIKE '%$buscar%' ORDER BY id_paciente DESC");
//% en mySQL es un wildcharacter que s eusa con LIKE
//en la primera cargada de la pagina cuando 'buscar' no tiene valor la query queda como LIKE '%%' osea busca cualquier registro donde nombre termine en cualquier cosa y empiece con cualquier cosa
//es por eso que en la primera cargada de la pagina sin haber puesto nada en el buscador, salen todos los registros
//LIKE a% encuentra valores que empiecen con a y terminen en cualquier cosa
//LIKE %a encuentra valores que empiecen con cualquier cosa y temrinen con a.
//LIKE %or% encuentra valores que tengan or en cualquier posicion.
    while($datos=$sql->fetch_object()){
      $fecha_convertida = date("d/m/Y", strtotime($datos->fecha_nacimiento_p));
      ?>
          <tr>
          
          <th scope="row"><?= $datos->id_paciente ?></th>
      <td><?= $datos->pnom_paciente ?></td>
      <td><?= $datos->snom_paciente ?></td>
      <td><?= $datos->apellidopa_paciente ?></td>
      <td><?= $datos->apellidoma_paciente ?></td>
      <td><?= $fecha_convertida ?></td>
      <td><?= $datos->edad_paciente ?></td>
      <td><?= $datos->correo_paciente ?></td>
      <td><?= $datos->tel_paciente ?></td>
      <td>
            <a href="../expedientes/index.php?id_paciente=<?=$datos->id_paciente?>&pnom_paciente=<?=$datos->pnom_paciente?>&snom_paciente=<?=$datos->snom_paciente?>&apellidopa_paciente=<?=$datos->apellidopa_paciente?>&apellidoma_paciente=<?=$datos->apellidoma_paciente?>" class="btn btn-small btn-primary"><i class="fa-solid fa-folder"></i></a>
        </td>
      
    </tr>  
   <?php }
   ?>
  
  </tbody>
</table>
</div>
   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>