<?php
$titulo = "KeepMoments - Resultado de búsqueda";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/conexion-db.php";

$q = isset($_GET['q']) ? trim($_GET['q']) : null; // Parámetro del buscador simple
$tituloBusqueda = isset($_GET['titulo']) ? trim($_GET['titulo']) : '';
$fechaBusqueda = isset($_GET['fecha']) ? trim($_GET['fecha']) : '';
$paisBusqueda = isset($_GET['country']) ? trim($_GET['country']) : '';

// Si es búsqueda simple
if (!empty($q)) {
  $sql = "SELECT idFoto, titulo, fecha, pais, fichero, alternativo FROM fotos WHERE titulo LIKE ? OR fecha LIKE ? OR pais LIKE ? ORDER BY fecha DESC";
  $paramTypes = 'sss';
  $params = ['%' . $q . '%', '%' . $q . '%', '%' . $q . '%'];
}

// Si es búsqueda avanzada
else if (!empty($tituloBusqueda) || !empty($fechaBusqueda) || !empty($paisBusqueda)) {
  $sql = "SELECT idFoto, titulo, fecha, pais, fichero, alternativo FROM fotos WHERE 1=1";

  $paramTypes = '';
  $params = [];

  if (!empty($tituloBusqueda)) {
    $sql .= " AND titulo LIKE ?";
    $paramTypes .= 's';
    $params[] = "%" . $tituloBusqueda . "%";
  }
  if (!empty($fechaBusqueda)) {
    $sql .= " AND fecha = ?";
    $paramTypes .= 's';
    $params[] = $fechaBusqueda;
  }
  if (!empty($paisBusqueda)) {
    $sql .= " AND pais = ?";
    $paramTypes .= 's';
    $params[] = $paisBusqueda;
  }
  $sql .= " ORDER BY fecha DESC";
} else {
  echo "<p>Por favor, completa al menos un campo para realizar una búsqueda.</p>";
  exit;
}

$stmt = $conn->prepare($sql);

// asignamos los parámetros si hay alguno
if (!empty($params)) {
  $stmt->bind_param($paramTypes, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
?>
<main>
  <h1>Resultado de búsqueda</h1>

  <!-- Mostramos los datos de búsqueda -->
  <?php if (!empty($q)): ?>
    <section>
      <h2>Búsqueda simple:</h2>
      <p><strong>Término buscado:</strong> <?= htmlspecialchars($q, ENT_QUOTES, 'UTF-8'); ?></p>
    </section>
  <?php else: ?>
    <section>
      <h2>Búsqueda avanzada:</h2>
      <p><strong>Título:</strong> <?= htmlspecialchars($tituloBusqueda, ENT_QUOTES, 'UTF-8'); ?></p>
      <p><strong>Fecha:</strong> <?= htmlspecialchars($fechaBusqueda, ENT_QUOTES, 'UTF-8'); ?></p>
      <p><strong>País:</strong> <?= htmlspecialchars($paisBusqueda, ENT_QUOTES, 'UTF-8'); ?></p>
    </section>
  <?php endif; ?>

  <!-- Resultados -->
  <div id="container-main-search">
    <?php if ($result && $result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <article class="container-card-search">
          <a href="foto.php?id=<?= htmlspecialchars($row['idFoto'], ENT_QUOTES, 'UTF-8'); ?>">
            <img src="fotos/<?= htmlspecialchars($row['fichero'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?= htmlspecialchars($row['alternativo'], ENT_QUOTES, 'UTF-8'); ?>">
            <h2><?= htmlspecialchars($row['titulo'], ENT_QUOTES, 'UTF-8'); ?></h2>
          </a>
          <footer>
            <p>Fecha de publicación: <?= htmlspecialchars($row['fecha'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p>País: <?= htmlspecialchars($row['pais'], ENT_QUOTES, 'UTF-8'); ?></p>
          </footer>
        </article>
      <?php endwhile; ?>
    <?php else: ?>
      <p>No se encontraron resultados para la búsqueda.</p>
    <?php endif; ?>
  </div>
</main>

<?php
$stmt->close();
$conn->close();

include "inc/pie.php";
include "inc/html-end.php";
?>