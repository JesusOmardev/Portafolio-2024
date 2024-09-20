<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../../PHPMailer/Exception.php';
require '../../PHPMailer/PHPMailer.php';
require '../../PHPMailer/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    // USANDO SMTP DE GOOGLE
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Servidor SMTP de Google
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587; // 
    $mail->Username = 'ruanojesusomar@gmail.com'; // Tu dirección de correo de Gmail
    $mail->Password = 'baiy apfr pvzl uvjo'; // Tu contraseña de Gmail


    //Recipients
    $mail->setFrom('jesusomar.dev@gmail.com', 'Jesus Omar R.C');
    $mail->addReplyTo('omarj5161@gmail.com', 'Jesus Omar R.C');
    $mail->addAddress($_POST['email'], $_POST['name']);     //Add a recipient
    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Gracias por ponerte en contacto, en breve me contactaré contigo :D';
    $htmlContent = file_get_contents('../plantillaCorreo.html');
    $mail->Body = $htmlContent;

    $mail->AltBody = 'Gracias por contactar, obtendras respuesta muy pronto :D';
    $mail->send();

    echo 'Correo electrónico enviado :D';

    $mail2 = new PHPMailer(true);

    try {
        //Server settings
        $mail2->isSMTP();
        $mail2->Host = 'smtp.gmail.com';  // Servidor SMTP de Google
        $mail2->SMTPAuth = true;
        $mail2->SMTPSecure = 'tls'; // O 'ssl' si prefieres SSL
        $mail2->Port = 587; // 465 para SSL, 587 para TLS
        $mail2->Username = 'ruanojesusomar@gmail.com'; // Tu dirección de correo de Gmail
        $mail2->Password = 'baiy apfr pvzl uvjo'; // Tu contraseña de Gmail


        //Recipients
        $mail2->setFrom($_POST['email'], $_POST['name']);
        $mail2->addReplyTo($_POST['email'], $_POST['name']);
        $mail2->addAddress('omarj5161@gmail.com', 'Jesus Omar R.C');     //Add a recipient
        $mail2->addAddress('omarc97851@gmail.com', 'Jesus Omar R.C');     //Add a recipient

        //Content
        $mail2->isHTML(true);                                  //Set email format to HTML
        $mail2->Subject = 'Gracias por ponerte en contacto, en breve me contactaré contigo :D';
        // Enviar a traves de un iframe
        $mail2->Body = '<h1 style="text-align:center">Un Reclutador intenta ponerse en contacto 
    contigo, :D</h1><br><p><b>Contenido del mensaje</b></p>' . $_POST['message'] . '<p></p>';

        $mail2->AltBody = 'No soportas HTML weón';
        $mail2->send();
        echo 'Correo electrónico enviado :D';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail2->ErrorInfo}";
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}