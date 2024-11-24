<?php
include "inc/conexion-db.php";
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$esValido = false;
$usu = $_POST['usu'] ?? '';
$pwd = $_POST['pwd'] ?? '';

$sql = "SELECT IdUsuario, NomUsuario, Clave, Estilo FROM Usuarios WHERE NomUsuario = ?";
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


  // ESTO ES CÓDIGO FUNCIONAL, SE DEBERÍA HACER MEJOR -------------------------
  $idUsuario = $usuario['IdUsuario'];

  $sqlEstilo = "SELECT NomUsuario, Estilo, Fichero FROM Usuarios JOIN Estilos ON Estilo = IdEstilo WHERE NomUsuario = ?";
  $stmt = $conn->prepare($sqlEstilo);
  $stmt->bind_param("s", $usu);
  $stmt->execute();
  $resultEstilo = $stmt->get_result();
  $usuarioEstilo = $resultEstilo->fetch_assoc();
  if ($usuarioEstilo['Fichero'] != null) {
    $estiloUsuario = $usuarioEstilo['Fichero'];
  }

  // Comparar la contraseña
  if (password_verify($pwd, $usuario['Clave'])) { // Para contraseñas encriptadas
    $esValido = true;
    // $idUsuario = $usuario['IdUsuario'];
    // $estiloUsuario = $usuario['Estilo'];
  } else {
    // Si las contraseñas están en texto plano, usa esta línea temporalmente:
    $esValido = $pwd === $usuario['Clave'];
  }
}

if ($esValido) {
  $_SESSION['usuario'] = $usu;
  $_SESSION['idUsuario'] = $idUsuario;
  $_SESSION['estilo'] = $estiloUsuario;

  if (isset($_POST['recuerdame'])) {
    setcookie('usu', $usu, time() + (90 * 24 * 60 * 60), '/');
    setcookie('pwd', $pwd, time() + (90 * 24 * 60 * 60), '/');
    setcookie('idUsuario', $idUsuario, time() + (90 * 24 * 60 * 60), '/');
    setcookie('estilo', $estiloUsuario, time() + (90 * 24 * 60 * 60), '/');
    setcookie('ultima_visita', date('d/m/Y H:i'), time() + (90 * 24 * 60 * 60), '/');
  } else {
    setcookie('usu', '', time() - 3600, '/');
    setcookie('pwd', '', time() - 3600, '/');
    setcookie('estilo', '', time() - 3600, '/');
    setcookie('ultima_visita', '', time() - 3600, '/');
    setcookie('idUsuario', '', time() - 3600, '/');
  }

  header('Location: menu-usuario.php');
  exit;
} else {
  $mensajeError = urlencode('Usuario o contraseña incorrectos');
  header("Location: index.php?error=$mensajeError");
  exit;
}
