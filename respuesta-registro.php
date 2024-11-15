<?php
$titulo = "KeepMoments - Respuesta Registro";
include "inc/html-start.php";
include "inc/cabecera.php";

// almacenamos los datos del formulario y si no hay datos, asignamos un valor por defecto
$usuario = $_POST['usu'] ?? '';
$password = $_POST['pwd'] ?? '';
$repetirPassword = $_POST['pwd2'] ?? '';
$email = $_POST['email'] ?? '';
$genero = $_POST['genero'] ?? '';
$fnac = $_POST['fnac'] ?? '';
$city = $_POST['city'] ?? '';
$country = $_POST['country'] ?? '';
$errores = []; // Variable para errores

// si los campos están vacíos, añadimos un mensaje de error
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

// verificamos si hay errores
if (!empty($errores)) {
  // Si hay errores, redirige al formulario con mensajes de error en la URL
  $errorString = http_build_query(['errores' => $errores]);
  header("Location: registro.php?$errorString");
  exit;
}
?>
<main>
  <section id="res-registro">
    <h1>Datos Registrados</h1>
    <p><strong>Usuario:</strong> <?= $usuario; ?></p>
    <p><strong>Correo Electrónico:</strong> <?= $email; ?></p>
    <p><strong>Género:</strong> <?= $genero; ?></p>
    <p><strong>Fecha de Nacimiento:</strong> <?= $fnac; ?></p>
    <p><strong>Ciudad:</strong> <?= $city; ?></p>
    <p><strong>País:</strong> <?= $country; ?></p>
    <p><a class="btn" href="registro.php">Volver al formulario</a></p>
  </section>
</main>
<?php
include "inc/pie.php";
include "inc/html-end.php";
?>