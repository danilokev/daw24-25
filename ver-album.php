<?php
$titulo = "KeepMoments - Ver álbum";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/auth.php";

include "inc/conexion-db.php";

$albumId = $_GET['id'] ?? null;
if (!$albumId) {
    die("Álbum no especificado.");
}

// Consulta detalles del álbum
$sql = "SELECT * FROM Albumes WHERE IdAlbum = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $albumId);
$stmt->execute();
$album = $stmt->get_result()->fetch_assoc();

if (!$album) {
    die("Álbum no encontrado.");
}

// Consulta fotos del álbum
$sqlFotos = "SELECT * FROM Fotos WHERE AlbumId = ?";
$stmtFotos = $conn->prepare($sqlFotos);
$stmtFotos->bind_param("i", $albumId);
$stmtFotos->execute();
$resultFotos = $stmtFotos->get_result();
?>

<main>
  <h1><?= htmlspecialchars($album['Titulo']) ?></h1>
  <p><?= htmlspecialchars($album['Descripcion']) ?></p>
  <p><a href="añadir-foto.php?id=<?= $album['IdAlbum'] ?>">Añadir foto</a></p>

  <?php if ($resultFotos->num_rows > 0): ?>
    <ul>
      <?php while ($foto = $resultFotos->fetch_assoc()): ?>
        <li>
          <strong><?= htmlspecialchars($foto['Titulo']) ?></strong><br>
          <?= htmlspecialchars($foto['Descripcion']) ?>
        </li>
      <?php endwhile; ?>
    </ul>
  <?php else: ?>
    <p>Este álbum no tiene fotos.</p>
  <?php endif; ?>
</main>

<?php
include "inc/pie.php";
include "inc/html-end.php";
?>
