<?php
$titulo = "KeepMoments - Mis fotos";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/auth.php";

include "inc/conexion-db.php";

$usuarioId = $_SESSION['idUsuario'];
$sql = "SELECT Fotos.*, Albumes.titulo AS AlbumTitulo 
        FROM fotos 
        INNER JOIN albumes ON fotos.album = albumes.idAlbum
        WHERE albumes.usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuarioId);
$stmt->execute();
$result = $stmt->get_result();
?>

<main>
  <h1>Mis fotos</h1>
  <?php if ($result->num_rows > 0): ?>
    <ul>
      <?php while ($foto = $result->fetch_assoc()): ?>
        <li>
          <img src="fotos/<?= htmlspecialchars($foto['fichero'], ENT_QUOTES, 'UTF-8'); ?>" 
               alt="<?= htmlspecialchars($foto['titulo'], ENT_QUOTES, 'UTF-8'); ?>" 
               style="max-width: 200px; height: auto;"><br>
          <strong><?= htmlspecialchars($foto['titulo']) ?></strong><br>
          <?= htmlspecialchars($foto['descripcion']) ?><br>
          Álbum: <?= htmlspecialchars($foto['AlbumTitulo']) ?><br>
          <a href="ver-album.php?id=<?= $foto['album'] ?>">Ver álbum</a>
        </li>
      <?php endwhile; ?>
    </ul>
  <?php else: ?>
    <p>No tienes fotos subidas.</p>
  <?php endif; ?>
</main>

<?php
include "inc/pie.php";
include "inc/html-end.php";
?>
