<?php
$titulo = "KeepMoments - Datos de usuario";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/auth.php";
include "inc/conexion-db.php";

$idUsuario = $_SESSION['idUsuario'];
if (!isset($_SESSION['idUsuario']) || empty($_SESSION['idUsuario'])) {
  header("Location: index.php?error=ID de usuario no está definida");
  exit;
}

$sentenciaUsu = "SELECT `nomUsuario`, `clave`, `email`, `sexo`, `fNacimiento`, `ciudad`, `pais` FROM `usuarios` WHERE `idUsuario` = $idUsuario";
$sentenciaPais = "SELECT `idPais`, `nomPais` FROM `paises` ORDER BY `nomPais` ASC";

if(!($resultUsu = $conn->query($sentenciaUsu))) {
  echo "<p>Error al ejecutar la sentencia <b>$sentenciaUsu</b>: " . $conn->error . "</p>";
  exit;
}
if(!($resultPais = $conn->query($sentenciaPais))) {
  echo "<p>Error al ejecutar la sentencia <b>$sentenciaPais</b>: " . $conn->error . "</p>";
  exit;
}

$datos = $resultUsu->fetch_assoc();
$botonTexto = "Actualizar datos";

$paises = [];
if ($resultPais->num_rows > 0) {
  while ($row = $resultPais->fetch_assoc()) {
    $paises[] = $row;
  }
}
?>
<main>
  <?php include "inc/formulario-usuario.php" ?>
</main>
<?php
$resultPais->close();
$resultUsu->close();
$conn->close();

include "inc/pie.php";
include "inc/html-end.php";
?>