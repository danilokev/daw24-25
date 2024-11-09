<?php
$titulo = "KeepMoments - Detalle de Foto";
include "inc/html-start.php";
$usuario_identificado = true;
include "inc/cabecera.php";

// recuperamos el id de la URL, si no existe le asignamos 1
$id = $_GET['id'] ?? 1;

// Si el id es par muestra una foto, si es impar muestra otra
if ($id % 2 == 0) {
    $foto = [
        'src' => 'img/foto2.jpg',
        'titulo' => 'Bosque',
        'fecha' => '01/09/2024',
        'pais' => 'Argentina',
        'album' => 'Naturaleza',
        'usuario' => 'Usuario2'
    ];
} else {
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
                <p><?= $foto['usuario']; ?></p>
            </a>
        </div>
        <img src="<?= $foto['src'] ?>" alt="<?= $foto['titulo']; ?>">
        <h2><?= $foto['titulo'] ?></h2>
        <p class="article-p">Fecha de publicación: <?= $foto['fecha']; ?></p>
        <p class="article-p">País: <?= $foto['pais']; ?></p>
        <p class="article-p">Álbum: <?= $foto['album']; ?></p>
        <button class="btn">Ver Álbum</button>
    </article>
</main>

<?php
include "inc/pie.php";
include "inc/html-end.php";
?>