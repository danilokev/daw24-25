<?php
$titulo = "KeepMoments - Registro";
include __DIR__ . "/../inc/html-start.php";
include __DIR__ . "/../inc/cabecera.php";
include __DIR__ . "/../inc/conexion-db.php";

if (isset($_SESSION['usuario']) || (isset($_COOKIE['usu']) && isset($_COOKIE['pwd']))) {
  header('Location: menu-usuario.php?notice=already_logged_in');
  exit;
}

$action = "respuesta-registro.php";
$id = "registrationForm";
$botonTexto = "Registrarse";
$textoLabelPdw = "Contraseña";
$textoLabelPdw2 = "Repetir contraseña";
$textoLabelPerfil = "Foto de perfil";
$enctype = "multipart/form-data";
$errores = $_GET['errores'] ?? [];

$sql = "SELECT `idPais`, `nomPais` FROM `paises` ORDER BY `nomPais` ASC";
$result = $conn->query($sql);

// verificamos si hay resultados
$paises = [];
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $paises[] = $row;
  }
}
?>
<main class="main-form">
  <?php include __DIR__ . "/../inc/formulario-usuario.php" ?>
  <p class="form-footer">¿Tienes ya una cuenta? <a href="login.html">Inicia sesión</a></p>
</main>
<?php
$conn->close();
include __DIR__ . "/../inc/pie.php";
include __DIR__ . "/../inc/html-end.php";
?>