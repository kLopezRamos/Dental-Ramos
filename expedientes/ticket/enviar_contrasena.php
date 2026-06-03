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
if (isset($_POST["contrasena_".$datos->id_empleado])) {
    $usuario=$_POST['usuario'];
    $contrasena=$_POST['constrasena'];
    $correo=$_POST['correo'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   
    <p>Usuario: <?=$usuario?></p>
    <p>Contraseña: <?=$contrasena?></p>
    
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
        $mail->Subject = 'Tu cuenta en Dental Ramos';
        $mail->Body = $html;
       // $mail->Body = 'Usuario: '.$usuario.' '. 'Contraseña: '.$contrasena;

        // Enviar el correo
        if ($mail->send()) {
            ?>
            <script type="text/javascript">
    window.location.href = './ver_empleados.php';
</script>

            <?php
            //header("location:./ver_empleados.php");
            
        } else {
            echo 'No se pudo enviar el correo.';
        }
    } catch (Exception $e) {
        // Manejo de errores
        echo "Error al enviar: {$mail->ErrorInfo}";
    }

}
?>
