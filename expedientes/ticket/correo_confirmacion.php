<?php

// Incluir PHPMailer antes de cualquier lógica
require_once 'PHPMailer/Exception.php';
require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

ob_start(); 
// Verificar si el formulario fue enviado
if (isset($_POST["cita_".$datos->no_cita])) {
    $no_cita=$_POST['no_cita'];
    $fecha_cita=$_POST['fecha_cita'];
    $correo=$_POST['correo'];
    $nombre=$_POST['nombre'];
    $fecha_convertida = date("d/m/Y", strtotime($fecha_cita));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    

</head>
<body>
    
    <H3>Hola! <?=$nombre?></H3>
    <h4>Porfavor, confirma tu cita en Dental Ramos para el día <?=$fecha_convertida?></h4>
    <br>
    <a href="http://localhost/proyecto2-php/loginNUEVO/confirmar_cita.php?no_cita=<?=$no_cita?>">CONFIRMAR CITA</a>
    

</body>
</html>
<?php

 $html = ob_get_clean();

    // Crear instancia de PHPMailer
    $mail = new PHPMailer(true);
          require_once __DIR__ . '/../../vendor/autoload.php';
            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/../../');
            $dotenv->load();
    try {
                // Configuración del servidor
        $mail->SMTPDebug = 0; // Habilitar salida de depuración
        $mail->isSMTP(); // Enviar usando SMTP
        $mail->Host = $_ENV['SMTP_HOST']; // Servidor SMTP
        $mail->SMTPAuth = true; // Habilitar autenticación SMTP
        $mail->Username = $_ENV['SMTP_USER'];; // Nombre de usuario SMTP
        $mail->Password = $_ENV['SMTP_PASS'];; // Contraseña SMTP
        $mail->SMTPSecure = 'tls'; // Habilitar cifrado TLS
        $mail->Port = $_ENV['SMTP_PORT'];; // Puerto TCP para conectarse

        // Destinatarios
        $mail->setFrom($_ENV['SMTP_USER'], 'Dental Ramos');
        $mail->addAddress($correo); // Añadir un destinatario


        // Contenido del correo
        $mail->isHTML(true); // Establecer el formato del correo como HTML
        $mail->Subject = 'Confirmacion de tu cita';
        $mail->Body = $html;
       // $mail->Body = 'Usuario: '.$usuario.' '. 'Contraseña: '.$contrasena;

        // Enviar el correo
        if ($mail->send()) {

            ?>
            <script type="text/javascript">
             window.location.href = './todas_citas.php';
         </script>
            <?php

        } else {
            echo 'No se pudo enviar el correo.';
        }
    } catch (Exception $e) {
        // Manejo de errores
        echo "Error al enviar: {$mail->ErrorInfo}";
    }

}
echo '<div class="good"><strong>Confirmación enviada enviada</strong></div>';

?>
