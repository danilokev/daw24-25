<?php
$titulo = "KeepMoments - Álbum";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/auth.php";
include "inc/conexion-db.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
  header("Location: index.php");
  $mensajeError = urlencode('Álbum no encontrado');
  header("Location: index.php?error=$mensajeError");
  exit;
}

$idAlbum = $_GET['id'];

$sqlAlbum = "SELECT titulo, descripcion, usuario FROM albumes WHERE idAlbum = $idAlbum";
$sqlFoto = "SELECT titulo, pais, fichero, alternativo, nomPais, fecha FROM fotos JOIN paises ON pais = idPais WHERE album = $idAlbum";

if (!($resultAlbum = $conn->query($sqlAlbum))) {
  echo "<p>Error al ejecutar la sentencia <b>$sqlAlbum</b>: " . $conn->error . "</p>";
  exit;
}
if (!($resultFoto = $conn->query($sqlFoto))) {
  echo "<p>Error al ejecutar la sentencia <b>$sqlFoto</b>: " . $conn->error . "</p>";
  exit;
}

$album = $resultAlbum->fetch_assoc();
$totalFotos = $resultFoto->num_rows;
$fechaMasAntigua = null;
$fechaMasReciente = null;

while ($foto = $resultFoto->fetch_assoc()) {
  $fecha = $foto['fecha'];
  if ($fechaMasAntigua == null || $fecha < $fechaMasAntigua) {
    $fechaMasAntigua = $fecha;
  }
  if ($fechaMasReciente == null || $fecha > $fechaMasReciente) {
    $fechaMasReciente = $fecha;
  }
}

$resultFoto->data_seek(0);
?>
<main>
  <section>
    <h1><?= $album['titulo'] ?></h1>
    <p><?= $album['descripcion'] ?></p>
    <p>Total de fotos: <?= $totalFotos ?></p>
    <p>Fecha antigua: <?= $fechaMasAntigua ?> y Fecha reciente: <?= $fechaMasReciente ?></p>
  </section>
  <article>
      <?php while ($foto = $resultFoto->fetch_assoc()): ?>
        <img src="fotos/<?= $foto['fichero'] ?>" alt="<?= $foto['alternativo'] ?>">
        <h2><?= $foto['titulo'] ?></h2>
        <p><?= $foto['nomPais'] ?></p>
      <?php endwhile; ?>
    </article>
</main>
<?php
$resultAlbum->close();
$resultFoto->close();
$conn->close();

include "inc/pie.php";
include "inc/html-end.php";
?>