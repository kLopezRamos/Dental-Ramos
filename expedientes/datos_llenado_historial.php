
<form  method="POST" > 
<?php
include "../modelo/conexion.php";
include "../controlador/datos_llenado_historial.php";
?>

<p>Oclusión:</p>
    <label><input type="checkbox" name="oclusion[]" value="Mordida"> Mordida</label><br>
    <label><input type="checkbox" name="oclusion[]" value="Desgaste"> Oclusion</label><br>
    <label><input type="checkbox" name="oclusion[]" value="Intercuspideo"> Intercuspideo</label><br>
    <label><input type="checkbox" name="oclusion[]" value="Onoclusión"> Onoclusión</label><br>
    <label><input type="checkbox" name="oclusion[]" value="Intercuspideo"> Ninguna</label><br>
    <br><br>
<p>Enfermedades personales:</p>
    <label><input type="checkbox" name="enfermedades[]" value="Aparato cardiovascular">Aparato cardiovascular</label><br>
    <label><input type="checkbox" name="enfermedades[]" value="Sistema nervioso">Sistema nervioso</label><br>
    <label><input type="checkbox" name="enfermedades[]" value="Sparato resporatorio">Aparato resporatorio</label><br>
    <label><input type="checkbox" name="enfermedades[]" value="Propension hemorragica">Propension hemorragica</label><br>
    <label><input type="checkbox" name="enfermedades[]" value="Renal">Renal</label><br>
    <label><input type="checkbox" name="enfermedades[]" value="Aparato digestivo">Aparato digestivo</label><br>
    <label><input type="checkbox" name="enfermedades[]" value="Diabetes">Diabetes</label><br>
    <label><input type="checkbox" name="enfermedades[]" value="Artritis">Artritis</label><br>
    <label><input type="checkbox" name="oclusion[]" value="Intercuspideo"> Ninguna</label><br>
    <br><br>
<p>Hábitos:</p>
    <label><input type="checkbox" name="habitos[]" value="Bricomania">Bricomanía</label><br>
    <label><input type="checkbox" name="habitos[]" value="Contracciones musculares">Contracciones musculares</label><br>
    <label><input type="checkbox" name="habitos[]" value="Hábitos de mordida">Hábitos de mordida</label><br>
    <label><input type="checkbox" name="habitos[]" value="Respiración bucal">Respiración bucal</label><br>
    <label><input type="checkbox" name="habitos[]" value="Labios">Labios</label><br>
    <label><input type="checkbox" name="habitos[]" value="Lengua">Lengua</label><br>
    <label><input type="checkbox" name="habitos[]" value="Dedos">Dedos</label><br>
    <label><input type="checkbox" name="oclusion[]" value="Intercuspideo"> Ninguno</label><br>
    <br><br>
<p>Otras condiciones:</p>
    <label><input type="checkbox" name="otras[]" value="Desmayos">Desmayos</label><br>
    <label><input type="checkbox" name="otras[]" value="Vértigos">Vértigos</label><br>
    <label><input type="checkbox" name="otras[]" value="Embarazo">Embarazo</label><br>
    <label><input type="checkbox" name="otras[]" value="Mareos">Mareos</label><br>
    <label><input type="checkbox" name="oclusion[]" value="Intercuspideo"> Ninguno</label><br>
    <br><br>
    <button type="submit" name="enviar" value="ok">Enviar</button>
</form>        

