<?php
// Verifica si el parámetro "id" está en la URL y si aún no se ha confirmado la eliminación
if (!empty($_GET["id"]) && empty($_GET["confirm"])) {
    ?>
    <script>
        if (confirm("¿Está seguro que desea eliminar este empleado? Se eliminarán todos los registros relacionados.")) {
            // Redirecciona con el parámetro de confirmación para ejecutar el código PHP de eliminación
            window.location.href = "<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $_GET['id']; ?>&confirm=1";
        } else {
            window.location.href = "<?php echo $_SERVER['PHP_SELF']; ?>";
        }
    </script>
    <?php
}
// Ejecuta el código de eliminación solo si se ha confirmado
if (!empty($_GET["id"]) && !empty($_GET["confirm"]) && $_GET["confirm"] == 1) {
    $id = $_GET["id"];
    $sql = $conexion->query("DELETE FROM empleado WHERE id_empleado=$id");

    if ($sql == 1) {
        echo '<div class="alert alert-warning">Empleado eliminado</div>';
    } else {
        echo '<div class="alert alert-warning">Error al eliminar</div>';
    }
}
?>