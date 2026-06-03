<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados registrados</title>
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
        .icono{
            width: 35px;
            height: 35px;
          }
    </style>

</head>
<body>
<div id="barra">
        <div id="calendario"><img src="../img/emp.png" class="icono"><h1>Empleados registrados</h1></div>
        <div id="regresar">
            <a href="../home.php" id="back">Regresar</a>
        </div>
    </div>
    


    <!--boton de nuevo reporte-->
<div class="container-fluid " >
    <a class="btn btn-primary mt-3 m-5" href="registrar_empleado.php"><i class="fa-solid fa-user-plus"></i> Registrar empleado</a>
    </div>
    <?php
    include "../modelo/conexion.php";
    include "../controlador/empleado/eliminar_empleado.php"
    ?>
<div class="container-fluid" >
  
    <form class="col-4 p-3 m-auto" method="POST">
  <div class="mb-3 ">
  <h5 class="text-center text-secondary">Buscar empleado</h5>
    <label for="exampleInputEmail1" class="form-label">Ingresar primer nombre ó apellido</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="buscar">
    
</div>
 
  <button type="submit" class="btn btn-primary " name="registrar" value="ok">Buscar</button>
  
</form>

<div class="col-20 p-1">
    
<table class="table">
<h5 class="text-center text-secondary">Empleados Registrados</h5>
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
      <th scope="col">Edad</th>
      <th scope="col">Ocupación</th>
      <th scope="col">Correo</th>
      <th scope="col">Teléfono</th>
      <th scope="col">Rol</th>
      <th scope="col">Enviar contraseña</th>
    </tr>
  </thead>
  <tbody>
    <?php
    include "../modelo/conexion.php";
  
$buscar = ""; // Inicializamos la variable para evitar el error al carga la pagina por primera vez, aqui esoty diciendo que el valor sea un acadena vacia en un inicio
if (isset($_POST['buscar'])) { //isset verifica que se haya enviado el valor ''buscar' (que es en name en) mediante el formulario, es decir que 'buscar' tenga valor
    $buscar = $_POST['buscar'];

}
    $sql = $conexion->query("SELECT * FROM empleado WHERE pnom_empleado LIKE '%$buscar%' OR apellidopa_empleado LIKE '%$buscar%' ORDER BY id_empleado DESC");
//% en mySQL es un wildcharacter que s eusa con LIKE
//en la primera cargada de la pagina cuando 'buscar' no tiene valor la query queda como LIKE '%%' osea busca cualquier registro donde nombre termine en cualquier cosa y empiece con cualquier cosa
//es por eso que en la primera cargada de la pagina sin haber puesto nada en el buscador, salen todos los registros
//LIKE a% encuentra valores que empiecen con a y terminen en cualquier cosa
//LIKE %a encuentra valores que empiecen con cualquier cosa y temrinen con a.
//LIKE %or% encuentra valores que tengan or en cualquier posicion.
    while($datos=$sql->fetch_object()){
      $fecha_convertida = date("d/m/Y", strtotime($datos->fecha_nacimiento_emp));
      $fecha_nacimiento = $datos->fecha_nacimiento_emp; // Ejemplo de fecha de nacimiento
        $fecha_nacimiento = new DateTime($fecha_nacimiento);
        $hoy = new DateTime(); // Fecha actual
        $edad = $hoy->diff($fecha_nacimiento)->y; // Obtiene la diferencia en años
      ?>
          <tr>
          <td>
        <a href="./ver_empleados.php?id=<?=$datos->id_empleado?>" class="btn btn-small btn-danger"><i class="fa-solid fa-trash-can"></i></a>
      </td>
          <td>
        <a href="./modificar_empleado.php?id=<?=$datos->id_empleado?>" class="btn btn-small btn-warning"><i class="fa-regular fa-pen-to-square"></i></a>
      </td>
     
          <th scope="row"><?= $datos->id_empleado?></th>
      <td><?= $datos->pnom_empleado ?></td>
      <td><?= $datos->snom_empleado ?></td>
      <td><?= $datos->apellidopa_empleado ?></td>
      <td><?= $datos->apellidoma_empleado ?></td>
      <td><?= $fecha_convertida ?></td>
      <td><?= $edad ?></td>
      <td><?= $datos->ocupacion_empleado ?></td>
      <td><?= $datos->correo ?></td>
      <td><?= $datos->telefono_empleado ?></td>
      <td><?= ($datos->role == 'user') ? 'Usuario' : 'Administrador' ?></td>

      <td style="text-align: center;">
      <form  method="POST">
        <input type="hidden" name="usuario" value="<?= $datos->usuario ?>">
        <input type="hidden" name="constrasena" value="<?= $datos->contrasena ?>">
        <input type="hidden" name="correo" value="<?= $datos->correo ?>">

        <button type="submit" class="btn btn-small btn-light" name="contrasena_<?=$datos->id_empleado; ?>" ><i class="fa-solid fa-paper-plane"></i></button>
        <?php
        include "../expedientes/ticket/enviar_contrasena.php";  // Solo incluye y ejecuta este archivo si se ha enviado el formulario
        ?> 
      </form>  
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