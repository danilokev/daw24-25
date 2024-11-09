<?php
session_start();
$titulo = "KeepMoments - Página principal";
include "inc/html-start.php";
$usuario_identificado = false;
include "inc/cabecera.php";
?>
<main>
  <h1>Últimas fotos subidas</h1>

  <?php if (isset($_SESSION['error'])): ?> 
    <div class="error-message" style="text-align: center; margin: 20px; font-size: 18px; background-color: #ffebee;padding: 20px;">
      <?php
      echo $_SESSION['error']; 
      unset($_SESSION['error']); // elimino el mensaje de error
      ?>
    </div>
  <?php endif; ?>
  
  <div class="container-photos">
    <a href="login.php">
      <figure>
        <img src="img/foto1.jpg" alt="Abeja en flor amarilla">
        <figcaption>Abeja</figcaption>
      </figure>
    </a>
    <a href="login.php">
      <figure>
        <img src="img/foto2.jpg" alt="Bosque verde">
        <figcaption>Bosque</figcaption>
      </figure>
    </a>
    <a href="login.php">
      <figure>
        <img src="img/foto3.webp" alt="Atardecer en el bosque">
        <figcaption>Atardecer en el bosque</figcaption>
      </figure>
    </a>
    <a href="login.php">
      <figure>
        <img src="img/foto4.webp" alt="Plantas iluminadas con un rayo de sol">
        <figcaption>Plantas</figcaption>
      </figure>
    </a>
    <a href="login.php">
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