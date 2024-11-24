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

// echo '<pre>';
// print_r($_SESSION);
// print_r($_COOKIE);
// echo '</pre>';
?>
<main>
  <h1>Últimas fotos subidas</h1>

  <?php if (isset($_GET['error'])): ?>
    <div class="error-message" style="text-align: center; margin: 20px; font-size: 20px; background-color: #ffebee;padding: 20px;">
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