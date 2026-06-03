<?php
// Incluir autoload de Dompdf antes de cualquier lógica
require_once('./dompdf/autoload.inc.php');
// Incluir PHPMailer antes de cualquier lógica
require_once 'PHPMailer/Exception.php';
require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';
use Dompdf\Dompdf;
use Dompdf\Options;



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

ob_start(); // Iniciar el almacenamiento en búfer


  
    // Aquí va el resto de tu lógica
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura de Pago</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;

    color: #333;
}

.invoice-container {
    max-width: 100%;
    background: #ffffff;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    font-family: 'Arial', sans-serif;
}

header {
    text-align: center;
    border-bottom: 2px solid #2c3e50;
    padding-bottom: 15px;
    margin-bottom: 20px;
}

header h1 {
    font-size: 1.8em;
    color: #2c3e50;
    font-weight: 700;
}

header p {
    color: #7f8c8d;
    font-size: 0.9em;
}

.invoice-header {
    text-align: center;
    background-color: #ecf0f1;
    padding: 10px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.invoice-header h2 {
    font-size: 1.6em;
    color: #16a085;
}

.patient-info, .treatment-info, .consultorio-info {
    background-color: #f7f9fa;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.patient-info h3, .treatment-info h3, .consultorio-info h3 {
    font-size: 1.2em;
    color: #2980b9;
    margin-bottom: 10px;
    border-bottom: 1px solid #bdc3c7;
    padding-bottom: 5px;
}

.patient-info p, .treatment-info p, .consultorio-info p {
    font-size: 0.95em;
    color: #2c3e50;
    margin-bottom: 8px;
}

strong {
    color: #34495e;
}

footer {
    text-align: center;
    font-size: 0.9em;
    color: #95a5a6;
    margin-top: 20px;
}

footer p {
    margin-top: 10px;
}

footer p:last-child {
    font-style: italic;
    color: #16a085;
}

    </style>
</head>
<body>
<?php
    $fechaActual = date("d/m/Y");
    $sql_datos=$conexion->query("SELECT correo_paciente, pnom_paciente, apellidopa_paciente, apellidoma_paciente FROM paciente WHERE id_paciente='$id_paciente'");
        $datos_paciente=$sql_datos->fetch_object();
        $correo=$datos_paciente->correo_paciente;
?>
    <div class="invoice-container">
        <header>
            <h1>Consultorio Dental Ramos</h1>
            <p>Dirección: Calle Av Las Palmas 5254A, Valle Verde 1, 64360 Monterrey, N.L.</p>
        </header>
        
        <section class="invoice-header">
            <h2>Factura de Pago</h2>
            <p>Fecha de emisión: <span id="fecha"><?php echo $fechaActual; ?></span></p>
        </section>

        <section class="patient-info">
            <h3>Datos del Paciente</h3>
            <p><strong>Nombre:</strong> <?=$primer_nombre . ' ' . $segundo_nombre. ' '. $apellidopa. ' '.$apellidoma?></p>
            <p><strong>RFC:</strong> <?=$rfc_paciente?></p>
        </section>

        <section class="treatment-info">
            <h3>Detalle del Tratamiento</h3>
            <p><strong>Tratamiento:</strong></p>
            <p><?=$diagnostico?></p>
            <p><strong>Realizado el día:</strong> <?=$fecha_convertida?></p>
            <p><strong>Método de Pago:</strong> <?=$metodo_pago?></p>
            <p><strong>Total:</strong> $<?=$total?></p>
        </section>

        <section class="consultorio-info">
            <h3>Detalles del Consultorio</h3>
            <p><strong>Nombre del Consultorio:</strong> <?=$nombre_consultorio?></p>
            <p><strong>RFC del Consultorio:</strong> <?=$rfc_consultorio?></p>
        </section>

        <footer>
            <p>Gracias por su preferencia</p>
            <p>_____________________________</p>
            <p>Aplica validez fiscal</p>
        </footer>
    </div>

    <script>
        document.getElementById("fecha").textContent = new Date().toLocaleDateString();
    </script>
</body>
</html>



    <?php
    $html = ob_get_clean();

    // Crear el objeto Dompdf
    $dompdf = new Dompdf();

    // Cargar el HTML en Dompdf
    $dompdf->loadHtml($html);

    // Configurar el tamaño del papel
  
    //$dompdf->setPaper([0, 0, 559.37, 283.46], 'landscape'); // Tamaño en puntos para una media carta en horizontal
    $dompdf->setPaper('letter', 'portrait');    // Renderizar el PDF
    $dompdf->render();

    // Generar el archivo PDF
    $pdfFilePath = 'factura'.'.pdf';
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
        $mail->Body = 'Factura de pago de su cita en Dental Ramos';

        // Enviar el correo
        if ($mail->send()) {
            $sql_verificar=$conexion->query("SELECT id_ticket FROM factura WHERE id_ticket='$id_ticket' LIMIT 1");

            if ($sql_verificar && $sql_verificar->num_rows === 0) {
            $sql_factura=$conexion->query("INSERT INTO factura(pnom_paciente,snom_paciente,apellidopa_paciente,apellidoma_paciente,rfc_paciente,descripcion_servicio,precio_trat,rfc_consultorio,nombre_consultorio,metodo_de_pago,id_ticket) 
            values('$primer_nombre', '$segundo_nombre', '$apellidopa', '$apellidoma', '$rfc_paciente', '$diagnostico', '$total', '$rfc_consultorio', '$nombre_consultorio', '$metodo_pago', '$id_ticket')");
            }   
            
            //CAMBIO AGREGUE CODICIONAL DE NO CITA
            $url = "../tratamientos.php?no_seguimiento=" . urlencode($no_seguimiento) .
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
          // Eliminar el archivo PDF temporal
          unlink($pdfFilePath);
        // Manejo de errores
        echo "Error al enviar: {$mail->ErrorInfo}";
    }
    
    

ob_end_flush(); ?>
