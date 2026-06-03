<?php
// Incluir autoload de Dompdf antes de cualquier lógica
require_once('./ticket/dompdf/autoload.inc.php');
use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('defaultFont', 'Courier');
$dompdf = new Dompdf($options);

// Incluir PHPMailer antes de cualquier lógica
require_once 'PHPMailer/Exception.php';
require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

ob_start(); // Iniciar el almacenamiento en búfer

// Verificar si el formulario fue enviado
if (isset($_POST["ticket_".$datost->no_tratamiento])) {

  
    // Aquí va el resto de tu lógica
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
      
        /* Ajuste de los elementos internos para evitar cortes */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f5f5f5;
            color: #333;
        }

        .ticket {
            /*margin-top:80px;*/
            width: 85%; /* Asegura que ocupe todo el ancho de la página */
            max-width: 80mm; /* Ancho del ticket */
            margin: 20px auto 0;/* Centra el contenido */
            font-size: 12px;
           /*text-align: center;*/
            word-wrap: break-word; /* Permite el ajuste de palabras */
        }

        .ticket-header {
            text-align: center;
            margin-bottom: 15px;
        }

        .ticket-header h2 {
            font-size: 18px;
            color: #333;
            margin-bottom: 5px;
        }

        .ticket-header p {
            font-size: 12px;
            color: #666;
        }

        .ticket-details {
            margin-bottom: 15px;
        }

        .ticket-details p {
            font-size: 11px;
            line-height: 1.6;
        }

        .ticket-item {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            padding: 5px 0;
            border-bottom: 1px dotted #ddd;
        }

        .ticket-total {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            font-weight: bold;
            padding: 10px 0;
            border-top: 2px solid #333;
        }

        .ticket-footer {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-top: 15px;
        }

    </style>
    </head>
    <body>
    <?php
    $fechaActual = date("d/m/Y");
?>
        <?php
        $sql_datos=$conexion->query("SELECT correo_paciente, pnom_paciente, apellidopa_paciente, apellidoma_paciente FROM paciente WHERE id_paciente='$id_paciente'");
        $datos_paciente=$sql_datos->fetch_object();
        $correo=$datos_paciente->correo_paciente;
        $nombre=$datos_paciente->pnom_paciente;
        $apellido=$datos_paciente->apellidopa_paciente;
        $apellido_ma=$datos_paciente->apellidoma_paciente;


        //$sql_motivo_cita=$conexion->query("SELECT motivo_cita FROM cita WHERE no_cita = '$no_cita'");
        //$motivo=$sql_motivo_cita->fetch_object();

        //$motivo_cita=$motivo->motivo_cita;
//CAMBIO AGREGUE motivo cita en etse query para que no se necesite no cita mas que en la URL
        $sql_diagnostico=$conexion->query("SELECT tratamiento_trat, metodo_pago, motivo_cita FROM tratamiento WHERE no_tratamiento ='$no_tratamiento'");
        $diagnostico=$sql_diagnostico->fetch_object();

        $diagnostico_cita=$diagnostico->tratamiento_trat;
        $motivo_cita=$diagnostico->motivo_cita;
        $metodo_pago = is_null($diagnostico->metodo_pago) ? 'no registrado' : $diagnostico->metodo_pago;

        ?>

        <div class="ticket">
        <div class="ticket-header">
            <h2>Dental Ramos</h2>
            <p>Calle Av Las Palmas 5254A, Valle Verde 1, 64360 Monterrey, N.L.</p>
            <p>Teléfono: (555) 123-4567</p>
        </div>

        <div class="ticket-details">
            <p><strong>Fecha de consulta:</strong> <?=$fecha_convertida?></p>
            <p><strong>No. Ticket:</strong><?=$no_tratamiento?>-<?=$id_paciente?></p>
            <p><strong>Cliente:</strong> <?=$nombre.' '.$apellido. ' '.$apellido_ma?></p>
            <br>
            <p><strong>Motivo de cita:</strong> <?=$motivo_cita?></p>
            <p><strong>Diagnostico:</strong></p>
            <p><?=$diagnostico_cita?></p>



        </div>
        <div class="ticket-item">
            <span>Método de pago:</span>
            <span><?=$metodo_pago?></span>
        </div>

        <div class="ticket-total">
            <span>Total:</span>
            <span>$<?=$precio_trat?></span>
        </div>

        <div class="ticket-footer">
            <p>Gracias por su confianza</p>
            <p>@dental.ramos</p>
            <p>Fecha de emisión: <?php echo $fechaActual; ?></p>
        </div>
    </div>

    </body>
    </html>
    <?php
    $html = ob_get_clean();

    // Crear el objeto Dompdf
    $dompdf = new Dompdf();

    // Cargar el HTML en Dompdf
    $dompdf->loadHtml($html);

    // Configurar el tamaño del papel
  
    $dompdf->setPaper([0, 0, 226.77, 425.196], 'portrait');

    // Renderizar el PDF
    $dompdf->render();

    // Generar el archivo PDF
    $pdfFilePath = 'recibo_pago' . $id_paciente. $nombre . '.pdf';
    file_put_contents($pdfFilePath, $dompdf->output());

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

        // Adjuntar el archivo PDF
        $mail->addAttachment($pdfFilePath);

        // Contenido del correo
        $mail->isHTML(true); // Establecer el formato del correo como HTML
        $mail->Subject = 'Documento PDF';
        $mail->Body = 'Recibo de pago de su cita en Dental Ramos';

        // Enviar el correo
        if ($mail->send()) {
            include "../modelo/conexion.php";
            $sql_pagado = $conexion->query("UPDATE tratamiento
            SET pagado = 1 WHERE no_tratamiento = '$no_tratamiento'");
            
            $sql_verificar=$conexion->query("SELECT no_tratamiento FROM ticket WHERE no_tratamiento='$no_tratamiento' LIMIT 1");

            if ($sql_verificar && $sql_verificar->num_rows === 0) {
            $sql_ticket=$conexion->query("INSERT INTO ticket(no_tratamiento,fecha_cita,precio_trat) values('$no_tratamiento', '$fecha_cita', '$precio_trat')");
            }          
   //CAMBIO AGREGUE CODICIONAL DE NO CITA
   $url = "./tratamientos.php?no_seguimiento=" . urlencode($no_seguimiento) .
   "&nombre_seguimiento=" . urlencode($nom_seguimiento) .
   "&id_paciente=" . urlencode($id_paciente);

   // Solo agrega `no_cita` si está definido
   if (isset($no_cita)) {
       $url .= "&no_cita=" . urlencode($no_cita);
   }
   
   ?>
   <script type="text/javascript">
    window.location.href = '<?=$url?>';
</script>
   <?php
//header("Location: $url");


        } else {
            echo 'No se pudo enviar el correo.';
        }

        // Eliminar el archivo PDF temporal
        unlink($pdfFilePath);

    } catch (Exception $e) {
        // Manejo de errores
          // Eliminar el archivo PDF temporal
          unlink($pdfFilePath);
        echo "Error al enviar: {$mail->ErrorInfo}";

    }

}
?>
