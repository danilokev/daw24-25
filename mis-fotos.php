<?php
$titulo = "KeepMoments - Mis fotos";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/auth.php";

include "inc/conexion-db.php";

$usuarioId = $_SESSION['idUsuario'];
$sql = "SELECT Fotos.*, Albumes.Titulo AS AlbumTitulo 
        FROM Fotos 
        INNER JOIN Albumes ON Fotos.AlbumId = Albumes.IdAlbum
        WHERE Albumes.UsuarioId = ?";
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
          <strong><?= htmlspecialchars($foto['Titulo']) ?></strong><br>
          <?= htmlspecialchars($foto['Descripcion']) ?><br>
          Álbum: <?= htmlspecialchars($foto['AlbumTitulo']) ?><br>
          <a href="ver-album.php?id=<?= $foto['AlbumId'] ?>">Ver álbum</a>
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
