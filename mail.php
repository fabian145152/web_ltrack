<?php
// === CONFIGURACIÓN DEL CORREO ===

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // Desactivar debug para que no rompa el header()
    $mail->SMTPDebug = 0;

    // Usar SMTP
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;

    // ⚠️ No publiques tus claves reales
    $mail->Username = "noguerolesfabian@gmail.com";
    $mail->Password = "qgrm otqy kjjk evic";

    $mail->SMTPSecure = "tls";
    $mail->Port = 587;

    // CONFIG DE CORREO
    $mail->setFrom($email, $name);
    $mail->addAddress("laboratorio.fabian@gmail.com");
    $mail->addCC("lucas.nogueroles@gmail.com");
    $mail->addCC($email);


    $mail->Subject = "Mensaje desde el formulario";
    $mail->isHTML(true);
    $mail->Body    = $email . "<br>" . $message;
    $mail->AltBody = strip_tags($message);

    $mail->send();

    // Redirección correcta
    header("Location: index.html");
    exit;
} catch (Exception $e) {
    echo "Error al enviar: {$mail->ErrorInfo}";
}

/*
Necesitas generar una "App Password" (contraseña de aplicación) en tu cuenta de Google.
Sin eso ningún script podrá autenticarse, aunque el usuario y la contraseña estén bien.

🔧 Pasos obligatorios:
1️⃣ Activa la verificación en dos pasos (2FA)

Entra aquí:

👉 https://myaccount.google.com/security

Activa "Verificación en dos pasos".

2️⃣ Crea una contraseña de aplicación

Ve a:

👉 https://myaccount.google.com/apppasswords

Te pedirá elegir:

Aplicación: Mail

Dispositivo: Other (otro) → escribe por ejemplo Servidor PHP

Google te generará algo así:

abcd efgh ijkl mnop


Esa es tu nueva contraseña real, la única que funciona para PHPMailer.

3️⃣ Usa esa contraseña en tu código
$mail->Username = "noguerolesfabian@gmail.com";
$mail->Password = "la_contraseña_de_aplicación_de_16_caracteres";


No uses tu contraseña normal → NO funciona.

❗ Tu script ya está bien. El problema es SOLO la autenticación.

Ahora mismo Gmail te dice literalmente:

Application-specific password required.

Una vez pongas la contraseña correcta, el correo se enviará sin más cambios.
*/