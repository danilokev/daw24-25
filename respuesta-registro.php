<?php
  $titulo = "KeepMoments - Página principal";
  include "inc/html-start.php";
  include "inc/cabecera.php";
?>

<?php
// Recoge los datos del formulario
$usuario = $_POST['usu'] ?? '';
$password = $_POST['pwd'] ?? '';
$repetirPassword = $_POST['pwd2'] ?? '';
$email = $_POST['email'] ?? '';
$genero = $_POST['genero'] ?? '';
$fnac = $_POST['fnac'] ?? '';
$city = $_POST['city'] ?? '';
$country = $_POST['country'] ?? '';

// Variables para errores
$errores = [];

// Validación de campos obligatorios
if (empty($usuario)) {
    $errores['usu'] = "El nombre de usuario es obligatorio.";
}
if (empty($password)) {
    $errores['pwd'] = "La contraseña es obligatoria.";
}
if (empty($repetirPassword)) {
    $errores['pwd2'] = "Repetir la contraseña es obligatorio.";
} elseif ($password !== $repetirPassword) {
    $errores['pwd2'] = "Las contraseñas no coinciden.";
}

// Verifica si hay errores
if (!empty($errores)) {
    // Si hay errores, redirige al formulario con mensajes de error en la URL
    $errorString = http_build_query(['errores' => $errores, 'datos' => $_POST]);
    header("Location: registro.php?$errorString");
    exit;
}

// Si no hay errores, muestra los datos ingresados
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos de Registro</title>
</head>
<body>
    <h1>Datos Registrados</h1>
    <p><strong>Usuario:</strong> <?= htmlspecialchars($usuario) ?></p>
    <p><strong>Correo Electrónico:</strong> <?= htmlspecialchars($email) ?></p>
    <p><strong>Género:</strong> <?= htmlspecialchars($genero) ?></p>
    <p><strong>Fecha de Nacimiento:</strong> <?= htmlspecialchars($fnac) ?></p>
    <p><strong>Ciudad:</strong> <?= htmlspecialchars($city) ?></p>
    <p><strong>País:</strong> <?= htmlspecialchars($country) ?></p>
    <p><a href="registro.php">Volver al formulario</a></p>
</body>
</html>

<?php
  include "inc/pie.php";
  include "inc/html-end.php";
?>