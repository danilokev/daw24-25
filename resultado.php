<!--  
  Archivo: resultado.html
  En este archivo se muestra el resultado de la búsqueda de fotos.

  Creado por: Kevin Danilo, Marcos López el 23/09/2024

  Historial de cambios:
  23/09/2024 - Creación del archivo
-->
<?php
  $titulo = "KeepMoments - Solicitar álbum impreso";
  include "inc/html-start.php";
  include "inc/cabecera.php";
?>
  <main>
    <h1>Resultado de búsqueda</h1>
    <div id="container-main-search">
        <article class="container-card-search">
          <a href="foto.php?id=1">
            <img src="img/foto1.jpg" alt="Abeja en flor amarilla">
            <h2>Abeja</h2>
          </a>
          <footer>
            <p>Fecha de publicación: 01/09/2024</p>
            <p>País: España</p>
          </footer>
        </article>

        <article class="container-card-search">
          <a href="foto.php?id=2">
            <img src="img/foto2.jpg" alt="Bosque">
            <h2>Bosque</h2>
          </a>
          <footer>
            <p>Fecha de publicación: 01/09/2024</p>
            <p>País: Argentina</p>
          </footer>
        </article>
  
      <article class="container-card-search">
        <a href="foto.php?id=3">
          <img src="img/foto3.webp" alt="Abeja en flor amarilla">
          <h2>Atardecer en el bosque</h2>
        </a>
        <footer>
          <p>Fecha de publicación: 07/11/2022</p>
          <p>País: Japón</p>
        </footer>
      </article>
    </div>
    <div>
      <button id="btn-card-search" class="btn">Ver más</button>
    </div>
  </main>
  <?php
  include "inc/pie.php";
  include "inc/html-end.php";
?>