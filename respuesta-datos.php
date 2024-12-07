<?php
$titulo = "KeepMoments - Respuesta Registro";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/auth.php";
include "inc/conexion-db.php";

if (!isset($_SESSION['idUsuario']) || empty($_SESSION['idUsuario'])) {
  header("Location: index.html?error=ID de usuario no está definida");
  exit;
}

$idUsuario = $_SESSION['idUsuario'];

// recogo los datos del formulario
$usuario = $_POST['usu'] ?? '';
$pass = $_POST['pwd'] ?? '';
$repetirPass = $_POST['pwd2'] ?? '';
$email = $_POST['email'] ?? '';
$sexo = $_POST['genero'] ?? '';
$fNacimiento = $_POST['fnac'] ?? '';
$ciudad = $_POST['city'] ?? '';
$pais = $_POST['country'] ?? '';
// $errores = [];
$pwdActual = $_POST['pwd_actual'] ?? '';

// compruebo que la contraseña actual es correcta antes de actualizar los datos
$sentenciaConfirmar = mysqli_prepare($conn, "SELECT clave FROM usuarios WHERE idUsuario = ?");
mysqli_stmt_bind_param($sentenciaConfirmar, 'i', $idUsuario);
mysqli_stmt_execute($sentenciaConfirmar);
mysqli_stmt_bind_result($sentenciaConfirmar, $clave);
mysqli_stmt_fetch($sentenciaConfirmar);
mysqli_stmt_close($sentenciaConfirmar);

if ($pwdActual != $clave) {
  die("Error: la contraseña actual no es correcta");
}

// si el campo contraseña está vacio matengo sus datos originales de la base de datos 
$pass = !empty($pass) ? $pass : $clave;

// actualizo los datos del usuario
$sentencia = mysqli_prepare($conn, "UPDATE usuarios SET nomUsuario = ?, clave = ?, email = ?, sexo = ?, fNacimiento = ?, ciudad = ?, pais = ? WHERE idUsuario = ?");

mysqli_stmt_bind_param($sentencia, 'sssissii', $usuario, $pass, $email, $sexo, $fNacimiento, $ciudad, $pais, $idUsuario);

if (!mysqli_stmt_execute($sentencia)) {
  die("Error: no se pudo realizar la actualización");
}

mysqli_stmt_close($sentencia);
mysqli_close($conn);

// prueba con las cookies despues de actualiar los datos
setcookie("usu", $usuario, time() + 3600, "/");
?>
<main>
  <section>
    <h1>¡Tus datos han sido actualizados!</h1>
    <p>Estos son tus datos:</p>
    <ul>
      <li><strong>Nombre de usuario:</strong> <?= $usuario ?></li>
      <li><strong>Correo electrónico:</strong> <?= $email ?></li>
      <li><strong>Sexo:</strong> <?= $sexo ?></li>
      <li><strong>Fecha de nacimiento:</strong> <?= $fNacimiento ?></li>
      <li><strong>Ciudad:</strong> <?= $ciudad ?></li>
      <li><strong>País:</strong> <?= $pais ?></li>
    </ul>
  </section>
</main>
<?php
include "inc/pie.php";
include "inc/html-end.php";
?>