<!-- 
  Archivo: foto.html
  En este archivo se muestra la información detallada de una foto.

  Creado por: Kevin Danilo, Marcos López el 23/09/2024

  Historial de cambios:
  23/09/2024 - Creación del archivo
  -->
  <?php
$titulo = "KeepMoments - Detalle de Foto";
include "inc/html-start.php";
include "inc/cabecera.php";

// Recupera el id de la URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

// Datos de la foto (para esta práctica, los datos están hardcodeados)
if ($id % 2 === 0) {
    // Detalles para la foto del bosque
    $foto = [
        'src' => 'img/foto2.jpg',
        'titulo' => 'Bosque',
        'fecha' => '01/09/2024',
        'pais' => 'Argentina',
        'album' => 'Naturaleza',
        'usuario' => 'Usuario2'
    ];
} else {
    // Detalles para la foto de la abeja
    $foto = [
        'src' => 'img/foto1.jpg',
        'titulo' => 'Abeja en flor amarilla',
        'fecha' => '01/09/2024',
        'pais' => 'España',
        'album' => 'Insectos',
        'usuario' => 'Usuario1'
    ];
}
?>

<main>
    <h1>Detalle de la Foto</h1>
    <article class="container-card">
        <div id="article-account">
            <a href="menu-usuario.html">
                <span id="icon-account" class="icon-user-circle"></span>
                <p><?= htmlspecialchars($foto['usuario']) ?></p>
            </a>
        </div>
        <img src="<?= htmlspecialchars($foto['src']) ?>" alt="<?= htmlspecialchars($foto['titulo']) ?>">
        <h2><?= htmlspecialchars($foto['titulo']) ?></h2>
        <p class="article-p">Fecha de publicación: <?= htmlspecialchars($foto['fecha']) ?></p>
        <p class="article-p">País: <?= htmlspecialchars($foto['pais']) ?></p>
        <p class="article-p">Álbum: <?= htmlspecialchars($foto['album']) ?></p>
        <button class="btn">Ver Álbum</button>
    </article>
</main>

<?php
include "inc/pie.php";
include "inc/html-end.php";
?>
