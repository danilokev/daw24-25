<?php
$titulo = "KeepMoments - Menú de usuario";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/auth.php";
include "inc/saludo.php";
include "inc/mensaje.php";
?>
<main>
  <h1><?= $saludo . ' ' . $nombreUsuario ?></h1>
  
  <?php if ($mensaje): ?>
    <h2><?= htmlspecialchars($mensaje) ?></h2>
  <?php endif; ?>

  <div id="menu-usu">
    <ul>
      <li><a href="#"><span class="icon-user"></span>Modificar datos</a></li>
      <li><a href="#"><span class="icon-trash"></span>Darse de baja</a></li>
      <li><a href="mis-albumes.php"><span class="icon-picture"></span>Visualizar álbumes</a></li>
      <li><a href="crear-album.php"><span class="icon-plus"></span>Crear álbum nuevo</a></li>
      <li><a href="solicitar-album.php"><span class="icon-print"></span>Solicitar álbum impreso</a></li>
      <li><a href="salir.php"><span class="icon-logout"></span>Salir</a></li>
    </ul>
  </div>
</main>
<?php
include "inc/pie.php";
include "inc/html-end.php";
?>