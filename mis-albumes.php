<?php
$titulo = "KeepMoments - Mis álbumes";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/auth.php";
include "inc/conexion-db.php";

// Obtener el ID del usuario
$usuarioId = $_SESSION['idUsuario'];

// Consulta para obtener los álbumes del usuario actual
$sql = "SELECT * FROM albumes WHERE usuario = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
  die("Error al preparar la consulta: " . $conn->error);
}

$stmt->bind_param("i", $usuarioId);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
  die("Error en la consulta: " . $conn->error);
}
?>
<main>
  <h1>Mis álbumes</h1>
  <?php if ($result->num_rows > 0): ?>
    <ul>
      <?php while ($album = $result->fetch_assoc()): ?>
        <li>
          <strong><?= htmlspecialchars($album['titulo']) ?></strong><br>
          <?= htmlspecialchars($album['descripcion']) ?><br>
          <a href="ver-album.php?id=<?= $album['idAlbum'] ?>">Ver álbum</a>
        </li>
      <?php endwhile; ?>
    </ul>
  <?php else: ?>
    <p>No tienes álbumes creados.</p>
  <?php endif; ?>
</main>

<?php
include "inc/pie.php";
include "inc/html-end.php";
?>