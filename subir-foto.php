<?php
$titulo = "KeepMoments - Añadir foto";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/auth.php";
include "inc/conexion-db.php";

if (!isset($_SESSION['idUsuario']) || empty($_SESSION['idUsuario'])) {
  header("Location: index.html?error=ID de usuario no está definida");
  exit;
}

$usuarioId = $_SESSION['idUsuario'];

$errores = $_SESSION['errores'] ?? [];
$datos = $_SESSION['datos'] ?? [];

// elemino solo las variables temporales
unset($_SESSION['errores'], $_SESSION['datos']);

$albumId = $_GET['id'] ?? null; // TODO: hacer comprobación para el id obtenido por URL

$sql = "SELECT IdAlbum, Titulo FROM Albumes WHERE usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuarioId);
$stmt->execute();
$result = $stmt->get_result();

$sqlPaises = "SELECT * FROM paises";
$resultPaises = $conn->query($sqlPaises);

if (!$resultPaises) {
  die("Error: no se pudo mostrar el listado de países. " . $conn->error);
}
?>
<main>
  <form action="respuesta-subir-foto.php" method="post" enctype="multipart/form-data">
    <h1>Añadir foto</h1>
    <p class="form-input">
      <label for="titulo">Título:</label>
      <input type="text" name="titulo" id="titulo" value="<?= htmlspecialchars($datos['titulo'] ?? '') ?>">
      <?php if (isset($errores['titulo'])): ?>
        <span class="error-message"><?= htmlspecialchars($errores['titulo']) ?></span>
      <?php endif; ?>
    </p>
    <p class="form-input">
      <label for="descripcion">Descripción:</label>
      <textarea name="descripcion" id="descripcion"><?= htmlspecialchars($datos['descripcion'] ?? '') ?></textarea>
    </p>
    <p class="form-input">
      <label for="fecha">Fecha:</label>
      <input type="date" name="fecha" id="fecha" value="<?= htmlspecialchars($datos['fecha'] ?? '') ?>">
    </p>
    <p class="form-input">
      <label for="pais">País:</label>
      <select name="pais" id="pais">
        <?php if ($resultPaises->num_rows > 0): ?>
          <?php while ($pais = $resultPaises->fetch_assoc()): ?>
            <option value="<?= htmlspecialchars($pais['idPais']) ?>"
              <?= (isset($datos['pais']) && $datos['pais'] == $pais['idPais']) ? 'selected' : '' ?>>
              <?= htmlspecialchars($pais['nomPais']) ?>
            </option>
          <?php endwhile; ?>
        <?php endif; ?>
      </select>
    </p>
    <p class="form-input">
      <label for="foto">Foto:</label>
      <input type="file" name="foto" id="foto">
    </p>
    <p class="form-input">
      <label for="alternativo">Texto alternativo:</label>
      <input type="text" name="alternativo" id="alternativo" value="<?= htmlspecialchars($datos['alternativo'] ?? '') ?>">
      <?php if (isset($errores['alternativo'])): ?>
        <span class="error-message"><?= htmlspecialchars($errores['alternativo']) ?></span>
      <?php endif; ?>
    </p>
    <p class="form-input">
      <label for="album">Álbum:</label>
      <select name="album" id="album">
        <?php if ($result->num_rows > 0): ?>
          <?php while ($album = $result->fetch_assoc()): ?>
            <option value="<?= $album['IdAlbum'] ?>"
              <?= (isset($datos['album']) && $datos['album'] == $album['IdAlbum']) ? 'selected' : '' ?>>
              <?= htmlspecialchars($album['Titulo']) ?>
            </option>
          <?php endwhile; ?>
        <?php else: ?>
          <option value="">No tienes álbumes</option>
        <?php endif; ?>
      </select>
    </p>
    <p>
      <input class="btn" type="submit" value="Subir foto">
    </p>
  </form>
</main>
<?php
$resultPaises->close();
$conn->close();
include "inc/pie.php";
include "inc/html-end.php";
?>