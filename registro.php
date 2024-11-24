<?php
$titulo = "KeepMoments - Registro";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/conexion-db.php";

if (isset($_SESSION['usuario']) || (isset($_COOKIE['usu']) && isset($_COOKIE['pwd']))) {
  header('Location: menu-usuario.php?notice=already_logged_in');
  exit;
}

$action = "respuesta-registro.php";
$id = "registrationForm";
$botonTexto = "Registrarse";
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
  <?php include "inc/formulario-usuario.php" ?>
  <p class="form-footer">¿Tienes ya una cuenta? <a href="login.html">Inicia sesión</a></p>
</main>
<?php
$conn->close();
include "inc/pie.php";
include "inc/html-end.php";
?>