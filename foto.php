<?php
$titulo = "KeepMoments - Detalle de Foto";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/auth.php";
include "inc/conexion-db.php";

$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
  header("Location: index.php?error=Foto no encontrada");
  exit;
}

// Consulta SQL para obtener la información de la foto
$sql = "SELECT 
            Fotos.Titulo AS titulo_foto, 
            Fotos.Descripcion AS descripcion, 
            Fotos.Fecha AS fecha, 
            Fotos.Fichero AS fichero, 
            Paises.NomPais AS pais, 
            Albumes.Titulo AS album, 
            Usuarios.NomUsuario AS usuario,
            Usuarios.IdUsuario AS id_usuario
        FROM Fotos
        LEFT JOIN Paises ON Fotos.Pais = Paises.IdPais
        LEFT JOIN Albumes ON Fotos.Album = Albumes.IdAlbum
        LEFT JOIN Usuarios ON Albumes.Usuario = Usuarios.IdUsuario
        WHERE Fotos.IdFoto = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  header("Location: index.php?error=Foto no encontrada");
  exit;
}

$foto = $result->fetch_assoc();
?>
<main>
  <h1>Detalle de la Foto</h1>

  <?php if (isset($_GET['error'])): ?>
    <div class="error-message">
      <?= htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8'); ?>
    </div>
  <?php endif; ?>

  <article class="container-card">
    <div id="article-account">
      <a href="perfil-usuario.php?id=<?= $foto['id_usuario'] ?>">
        <span id="icon-account" class="icon-user-circle"></span>
        <p><?= htmlspecialchars($foto['usuario'], ENT_QUOTES, 'UTF-8'); ?></p>
      </a>
    </div>
    <img src="img/<?= htmlspecialchars($foto['fichero'], ENT_QUOTES, 'UTF-8'); ?>"
      alt="<?= htmlspecialchars($foto['titulo_foto'], ENT_QUOTES, 'UTF-8'); ?>">
    <h2><?= htmlspecialchars($foto['titulo_foto'], ENT_QUOTES, 'UTF-8'); ?></h2>
    <p class="article-p">Descripción: <?= htmlspecialchars($foto['descripcion'], ENT_QUOTES, 'UTF-8'); ?></p>
    <p class="article-p">Fecha de publicación: <?= htmlspecialchars($foto['fecha']); ?></p>
    <p class="article-p">País: <?= htmlspecialchars($foto['pais'], ENT_QUOTES, 'UTF-8'); ?></p>
    <p class="article-p">Álbum: <?= htmlspecialchars($foto['album'], ENT_QUOTES, 'UTF-8'); ?></p>
    <button class="btn">Ver Álbum</button>
  </article>
</main>
<?php
$stmt->close();
$conn->close();
include "inc/pie.php";
include "inc/html-end.php";
?>