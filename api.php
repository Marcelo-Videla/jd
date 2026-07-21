<?php
declare(strict_types=1);

$home = 'contacto.html';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . $home, true, 302);
    exit;
}

$nombre = trim((string)($_POST['nombre'] ?? ''));
$empresa = trim((string)($_POST['empresa'] ?? ''));
$correo = trim((string)($_POST['correo'] ?? ''));
$telefono = trim((string)($_POST['telefono'] ?? ''));
$mensaje = trim((string)($_POST['mensaje'] ?? ''));

$to = 'contacto@jdproducciones.cl';
$subject = 'Nuevo contacto desde JD PRODUCCIONES';
$body = "Nombre: {$nombre}\n";
$body .= "Empresa: {$empresa}\n";
$body .= "Correo: {$correo}\n";
$body .= "Telefono: {$telefono}\n\n";
$body .= "Mensaje:\n{$mensaje}\n";
$headers = [];
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-Type: text/plain; charset=UTF-8';
if ($correo !== '') {
    $headers[] = 'Reply-To: ' . $correo;
}

@mail($to, $subject, $body, implode("\r\n", $headers));

header('Location: ' . $home . '?enviado=1', true, 302);
exit;
