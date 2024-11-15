<?php
$titulo = "KeepMoments - Página principal";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/auth.php";
?>

<main>
  <h1>Últimas fotos subidas</h1>
  <div class="container-photos">
    <a href="foto.php?id=1">
      <figure>
        <img src="img/foto1.jpg" alt="Abeja en flor amarilla">
        <figcaption>Abeja</figcaption>
      </figure>
    </a>

    <a href="foto.php?id=2">
      <figure>
        <img src="img/foto2.jpg" alt="Bosque verde">
        <figcaption>Bosque</figcaption>
      </figure>
    </a>

    <a href="foto.php?id=3">
      <figure>
        <img src="img/foto3.webp" alt="Atardecer en el bosque">
        <figcaption>Atardecer en el bosque</figcaption>
      </figure>
    </a>

    <a href="foto.php?id=4">
      <figure>
        <img src="img/foto4.webp" alt="Plantas iluminadas con un rayo de sol">
        <figcaption>Plantas</figcaption>
      </figure>
    </a>

    <a href="foto.php?id=5">
      <figure>
        <img src="img/foto5.jpeg" alt="Guepardo posando">
        <figcaption>Lindo minino</figcaption>
      </figure>
    </a>
  </div>
</main>

<?php
include "inc/pie.php";
include "inc/html-end.php";
?>