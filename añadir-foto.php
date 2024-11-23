<?php
$titulo = "KeepMoments - Añadir foto";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/auth.php";

include "inc/conexion-db.php";

$usuarioId = $_SESSION['idUsuario'];
$albumId = $_GET['id'] ?? null;

// Consulta los álbumes del usuario
$sql = "SELECT IdAlbum, Titulo FROM Albumes WHERE UsuarioId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuarioId);
$stmt->execute();
$result = $stmt->get_result();
?>

<main>
  <h1>Añadir foto</h1>
  <form action="procesar-foto.php" method="post" enctype="multipart/form-data">
    <label for="titulo">Título:</label>
    <input type="text" name="titulo" id="titulo" required>
    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" id="descripcion" required></textarea>
    <label for="fecha">Fecha:</label>
    <input type="date" name="fecha" id="fecha" required>
    <label for="pais">País:</label>
    <input type="text" name="pais" id="pais" required>
    <label for="foto">Foto:</label>
    <input type="file" name="foto" id="foto" required>
    <label for="alternativo">Texto alternativo:</label>
    <input type="text" name="alternativo" id="alternativo" required>
    <label for="album">Álbum:</label>
    <select name="album" id="album" required>
      <?php if ($result->num_rows > 0): ?>
        <?php while ($album = $result->fetch_assoc()): ?>
          <option value="<?= $album['IdAlbum'] ?>" <?= $album['IdAlbum'] == $albumId ? 'selected' : '' ?>>
            <?= htmlspecialchars($album['Titulo']) ?>
          </option>
        <?php endwhile; ?>
      <?php else: ?>
        <option value="">No tienes álbumes</option>
      <?php endif; ?>
    </select>
    <button type="submit">Añadir foto</button>
  </form>
</main>

<?php
include "inc/pie.php";
include "inc/html-end.php";
?>
