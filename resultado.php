<!--  
  Archivo: resultado.php
  En este archivo se muestra el resultado de la búsqueda de fotos.

  Creado por: Kevin Danilo, Marcos López el 23/09/2024

  Historial de cambios:
  23/09/2024 - Creación del archivo
-->
<?php
$titulo = "KeepMoments - Resultado de búsqueda";
include "inc/html-start.php";
$usuario_identificado = false;
include "inc/cabecera.php";

// Almacenamos los valores introducidos en el formulario
$tituloBusqueda = $_GET['titulo'] ? $_GET['titulo'] : '-';
$fechaBusqueda = $_GET['fecha'] ? $_GET['fecha'] : '-';
$paisBusqueda = $_GET['country'] ? $_GET['country'] : '-';
?>

<main>
  <h1>Resultado de búsqueda</h1>

  <!-- Mostramos los datos que el usuario ha ingresado -->
  <section>
    <h2>Datos de búsqueda ingresados:</h2>
    <p><strong>Título:</strong> <?= $tituloBusqueda; ?></p>
    <p><strong>Fecha:</strong> <?= $fechaBusqueda; ?></p>
    <p><strong>País:</strong> <?= $paisBusqueda; ?></p>
  </section>

  <!-- Resultados estáticos de ejemplo -->
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
        <img src="img/foto3.webp" alt="Atardecer en el bosque">
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