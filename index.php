<?php
$titulo = "KeepMoments - Página principal";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/conexion-db.php";

// Consulta para obtener las últimas cinco fotos
$query = "SELECT Fotos.Titulo, Fotos.Fichero, Fotos.FRegistro, Paises.NomPais, Fotos.alternativo
          FROM Fotos
          JOIN Paises ON Fotos.Pais = Paises.IdPais
          ORDER BY Fotos.FRegistro DESC
          LIMIT 5";

$result = $conn->query($query);

$fotos = [];
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $fotos[] = $row;
  }
} else {
  $error = "No hay fotos disponibles en este momento.";
}

?>
<main>
  <h1>Últimas fotos subidas</h1>

  <?php if (isset($_GET['error'])): ?>
    <div class="error-message"
      style="text-align: center; margin: 20px; font-size: 20px; background-color: #ffebee;padding: 20px;">
      <?php
      echo htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8');
      ?>
    </div>
  <?php endif; ?>

  <div class="container-photos">
    <?php if (!empty($fotos)): ?>
      <?php foreach ($fotos as $foto): ?>
        <a href="login.php">
          <figure>
            <img src="fotos/<?= htmlspecialchars($foto['Fichero']) ?>" alt="<?= htmlspecialchars($foto['alternativo']) ?>">
            <figcaption>
              <?= htmlspecialchars($foto['Titulo']) ?>
            </figcaption>
          </figure>
        </a>
      <?php endforeach; ?>

      <?php
      $archivoCriticas = "fotos_criticas.txt";

      $fotoEscogida = null;
      if (file_exists($archivoCriticas)) {
        $lineas = file($archivoCriticas, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (!empty($lineas)) {
          $lineaRandom = $lineas[array_rand($lineas)];
          list($idFoto, $nombreCritico, $comentario) = explode('|', $lineaRandom);

          $queryFoto = $conn->prepare("SELECT Titulo, Fichero, FRegistro FROM Fotos WHERE IdFoto = ?");
          $queryFoto->bind_param("i", $idFoto);
          $queryFoto->execute();
          $resultadoFoto = $queryFoto->get_result();

          if ($resultadoFoto->num_rows > 0) {
            $fotoEscogida = $resultadoFoto->fetch_assoc();
            $fotoEscogida['Critico'] = $nombreCritico;
            $fotoEscogida['Comentario'] = $comentario;
          }
        }
      }
      $archivoConsejos = "consejos.json";

      $consejo = null;
      if (file_exists($archivoConsejos)) {
        $contenidoJson = file_get_contents($archivoConsejos);
        $consejos = json_decode($contenidoJson, true);
        if (!empty($consejos)) {
          $consejo = $consejos[array_rand($consejos)];
        }
      }
      ?>
      
      <div class="featured-photo">
        <h2>Foto Escogida</h2>
        <?php if ($fotoEscogida): ?>
          <figure>
            <img src="fotos/<?= htmlspecialchars($fotoEscogida['Fichero']) ?>"
              alt="<?= htmlspecialchars($fotoEscogida['Titulo']) ?>">
            <figcaption>
              <strong><?= htmlspecialchars($fotoEscogida['Titulo']) ?></strong><br>
              <em>Escogida por <?= htmlspecialchars($fotoEscogida['Critico']) ?></em><br>
              <?= htmlspecialchars($fotoEscogida['Comentario']) ?>
            </figcaption>
          </figure>
        <?php else: ?>
          <p>No hay fotos escogidas disponibles en este momento.</p>
        <?php endif; ?>
      </div>

      <div class="photo-tip">
        <h2>Consejo Fotográfico</h2>
        <?php if ($consejo): ?>
          <p><strong>Categoría:</strong> <?= htmlspecialchars($consejo['Categoria']) ?></p>
          <p><strong>Dificultad:</strong> <?= htmlspecialchars($consejo['Dificultad']) ?></p>
          <p><?= htmlspecialchars($consejo['Descripcion']) ?></p>
        <?php else: ?>
          <p>No hay consejos disponibles en este momento.</p>
        <?php endif; ?>
      </div>

    <?php else: ?>
      <p style="text-align: center; font-size: 18px; color: gray;">
        <?= isset($error) ? htmlspecialchars($error) : "No hay fotos para mostrar." ?>
      </p>
    <?php endif; ?>
  </div>
</main>
<?php
include "inc/pie.php";
include "inc/html-end.php";
?>