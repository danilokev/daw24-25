<?php
include "inc/conexion-db.php";
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$esValido = false;
$usu = $_POST['usu'] ?? '';
$pwd = $_POST['pwd'] ?? '';

$sql = "SELECT IdUsuario, NomUsuario, clave, Estilo FROM usuarios WHERE nomUsuario = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
  die("Error al preparar la consulta: " . $conn->error);
}

$stmt->bind_param("s", $usu);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si el usuario existe
if ($result->num_rows === 1) {
  $usuario = $result->fetch_assoc();

  $idUsuario = $usuario['IdUsuario'];
  $estiloUsuario = $usuario['Estilo'];
  
  // Comparar la contraseña utilizando password_verify()
  if (password_verify($pwd, $usuario['clave'])) {
    $esValido = true;
  }
}

if ($esValido) {
  $_SESSION['usuario'] = $usu;
  $_SESSION['idUsuario'] = $idUsuario;
  $_SESSION['estilo'] = $estiloUsuario;

  if (isset($_POST['recuerdame'])) {
    setcookie('usu', $usu, time() + (90 * 24 * 60 * 60), '/');
    setcookie('idUsuario', $idUsuario, time() + (90 * 24 * 60 * 60), '/');
    setcookie('estilo', $estiloUsuario, time() + (90 * 24 * 60 * 60), '/');
    setcookie('ultima_visita', date('d/m/Y H:i'), time() + (90 * 24 * 60 * 60), '/');
  } else {
    // Eliminar cookies si no se seleccionó "Recuérdame"
    setcookie('usu', '', time() - 3600, '/');
    setcookie('idUsuario', '', time() - 3600, '/');
    setcookie('estilo', '', time() - 3600, '/');
    setcookie('ultima_visita', '', time() - 3600, '/');
  }

  header('Location: menu-usuario.php');
  exit;
} else {
  $mensajeError = urlencode('Usuario o contraseña incorrectos');
  header("Location: index.php?error=$mensajeError");
  exit;
}