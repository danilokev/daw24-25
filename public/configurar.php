<?php
$titulo = "KeepMoments - Configurar";
include __DIR__ . "/../inc/html-start.php";
include __DIR__ . "/../inc/cabecera.php";
include __DIR__ . "/../inc/auth.php";
include __DIR__ . "/../inc/conexion-db.php";

$sqlEstilo = "SELECT `idEstilo`, `nombre`, `descripcion` FROM `estilos`";

if (!($resultEstilo = $conn->query($sqlEstilo))) {
  echo "<p>Error al ejecutar la sentencia <b>$sqlAlbum</b>: " . $conn->error . "</p>";
  exit;
}
?>
<main id="main-form-estilos">
  <form action="respuesta-configurar.php" method="get">
    <h1>Selecciona un estilo</h1>
    <p class="form-input">
      <label for="estilo">Elige un estilo:</label>
      <select name="estilo" id="estilo">
        <?php while ($estilo = $resultEstilo->fetch_assoc()): ?>
          <option value="<?= $estilo['idEstilo']; ?>">
            <?= $estilo['nombre']; ?> - <?= $estilo['descripcion']; ?>
          </option>
        <?php endwhile; ?>
      </select>
    </p>
    <button class="btn" type="submit">Seleccionar estilo</button>
  </form>
</main>
<?php
$resultEstilo->close();
$conn->close();
include __DIR__ . "/../inc/pie.php";
include __DIR__ . "/../inc/html-end.php";
?>