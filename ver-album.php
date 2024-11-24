<?php
$titulo = "KeepMoments - Ver álbum";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/auth.php";
include "inc/conexion-db.php";

$albumId = $_GET['id'] ?? null;
if (!$albumId || !is_numeric($albumId)) {
  header("Location: index.php?error=Álbum no especificado");
  exit;
}

// Consulta de albumes
$sql = "SELECT * FROM albumes WHERE idAlbum = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $albumId);
$stmt->execute();
$album = $stmt->get_result()->fetch_assoc();

if (!$album) {
  die("Álbum no encontrado.");
}

// Consulta fotos del álbum
$sqlFotos = "SELECT * FROM fotos WHERE album = ?";
$stmtFotos = $conn->prepare($sqlFotos);
$stmtFotos->bind_param("i", $albumId);
$stmtFotos->execute();
$resultFotos = $stmtFotos->get_result();
?>
<main>
  <h1><?= htmlspecialchars($album['titulo']) ?></h1>
  <p><?= htmlspecialchars($album['descripcion']) ?></p>
  <p><a href="subir-foto.php?id=<?= $album['idAlbum'] ?>">Añadir foto</a></p>

  <?php if ($resultFotos->num_rows > 0): ?>
    <ul>
      <?php while ($foto = $resultFotos->fetch_assoc()): ?>
        <li>
          <strong><?= htmlspecialchars($foto['titulo']) ?></strong><br>
          <?= htmlspecialchars($foto['descripcion']) ?>
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