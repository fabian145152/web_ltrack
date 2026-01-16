<?php
// === CONFIGURACIÓN DEL CORREO ===
$to      = "info@ltrack.com.ar";  // <-- Cambiá esto por el email donde querés recibir los mensajes
$subject = "Nuevo mensaje desde el sitio de Rastreo GPS";
$from    = "no-reply@tudominio.com";  // <-- Dirección remitente (mejor si pertenece a tu dominio)

// === VALIDAR DATOS DEL FORMULARIO ===
$name    = isset($_POST['name']) ? trim($_POST['name']) : '';
$email   = isset($_POST['email']) ? trim($_POST['email']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

if ($name == '' || $email == '' || $message == '') {
    die("Por favor completá todos los campos.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Dirección de correo inválida.");
}

// === CONSTRUIR EL MENSAJE ===
$body = "Has recibido un nuevo mensaje desde el formulario de contacto:\n\n";
$body .= "Nombre: " . $name . "\n";
$body .= "Email: " . $email . "\n";
$body .= "Mensaje:\n" . $message . "\n\n";
$body .= "Enviado el " . date("d/m/Y H:i:s");

// === CABECERAS ===
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// === ENVIAR ===
if (mail($to, $subject, $body, $headers)) {
    echo "✅ Gracias, tu mensaje fue enviado correctamente.";
} else {
    echo "❌ Ocurrió un error al enviar el mensaje. Intentalo nuevamente.";
}
