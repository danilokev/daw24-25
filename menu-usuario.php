<?php
$titulo = "KeepMoments - Menú de usuario";
$usuario_identificado = true;
include "inc/html-start.php";
include "inc/cabecera.php";
?>
<main>
  <h1>Menú de usuario</h1>
  <div id="menu-usu">
    <ul>
      <li><a href="#"><span class="icon-user"></span>Modificar datos</a></li>
      <li><a href="#"><span class="icon-trash"></span>Darse de baja</a></li>
      <li><a href="#"><span class="icon-picture"></span>Visualizar álbumes</a></li>
      <li><a href="crear-album.php"><span class="icon-plus"></span>Crear álbum nuevo</a></li>
      <li><a href="solicitar-album.php"><span class="icon-print"></span>Solicitar álbum impreso</a></li>
      <li><a href="index.php"><span class="icon-logout"></span>Salir</a></li>
    </ul>
  </div>
</main>
<?php
include "inc/pie.php";
include "inc/html-end.php";
?>