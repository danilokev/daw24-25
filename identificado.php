<?php
$titulo = "KeepMoments - Página principal";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/auth.php";
include "inc/conexion-db.php"; 

// Consulta para obtener las últimas fotos subidas
$sql = "SELECT IdFoto, Titulo, Fichero FROM Fotos ORDER BY FRegistro DESC LIMIT 5";
$result = $conn->query($sql);

// Verificar si hay resultados
$fotos = [];
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $fotos[] = $row;
  }
} else {
  echo "<p>No hay fotos disponibles en este momento.</p>";
}

?>
<main>
  <h1>Últimas fotos subidas</h1>
  <div class="container-photos">
    <?php foreach ($fotos as $foto): ?>
      <a href="foto.php?id=<?= htmlspecialchars($foto['IdFoto'], ENT_QUOTES, 'UTF-8'); ?>">
        <figure>
          <img src="fotos/<?= htmlspecialchars($foto['Fichero'], ENT_QUOTES, 'UTF-8'); ?>"
            alt="<?= htmlspecialchars($foto['Titulo'], ENT_QUOTES, 'UTF-8'); ?>">
          <figcaption><?= htmlspecialchars($foto['Titulo'], ENT_QUOTES, 'UTF-8'); ?></figcaption>
        </figure>
      </a>
    <?php endforeach; ?>
  </div>
</main>
<?php
$conn->close();
include "inc/pie.php";
include "inc/html-end.php";
?>