<?php
$titulo = "KeepMoments - Página principal";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/auth.php";
include "inc/conexion-db.php";

$idUsuario = $_GET['id'];

if (!isset($_GET['id']) || empty($_GET['id'])) {
  header("Location: index.php");
  exit;
}

$sqlUser = "SELECT nomUsuario, foto, fRegistro FROM usuarios WHERE idUsuario = $idUsuario";
$sqlAlbum = "SELECT idAlbum, titulo FROM albumes WHERE usuario = $idUsuario";

if (!($resultUser = $conn->query($sqlUser))) {
  echo "<p>Error al ejecutar la sentencia <b>$sqlUser</b>: " . $conn->error . "</p>";
  exit;
}
if (!($resultAlbum = $conn->query($sqlAlbum))) {
  echo "<p>Error al ejecutar la sentencia <b>$sqlAlbum</b>: " . $conn->error . "</p>";
  exit;
}

$usuario = $resultUser->fetch_assoc();
?>
<main>
<section>
    <h1>Perfil de <?= $usuario['nomUsuario'] ?></h1>
    <img src="img/<?= $usuario['foto'] ?>" alt="Foto de perfil">
    <p>Fecha de incorporación: <?= $usuario['fRegistro'] ?></p>
    <h2>Álbumes</h2>
    <ul>
      <?php while ($album = $resultAlbum->fetch_assoc()): ?>
        <li><a href="album.php?id=<?= $album['idAlbum'] ?>"><?= $album['titulo'] ?></a></li>
      <?php endwhile; ?>
    </ul>
  </section>
</main>
<?php
$resultUser->close();
$resultAlbum->close();
$conn->close();

include "inc/pie.php";
include "inc/html-end.php";
?>