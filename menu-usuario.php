<?php
$titulo = "KeepMoments - Menú de usuario";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/auth.php";
include "inc/saludo.php";

// Actualizar la cookie con la última visita a esta página
setcookie('ultima_visita', date('Y-m-d H:i:s') . ' ', time() + (90 * 24 * 60 * 60), '/');

// Generar el mensaje de última visita (si aplica)
$mensajeUltimaVisita = '';
if (isset($_COOKIE['usu']) && isset($_COOKIE['ultima_visita'])) {
  $mensajeUltimaVisita = " (Su última visita fue el " . htmlspecialchars($_COOKIE['ultima_visita']) . ")";
}
?>
<main>
  <h1><?= $saludo . ' ' . $nombreUsuario . $mensajeUltimaVisita ?></h1>

  <div id="menu-usu">
    <ul>
      <li><a href="#"><span class="icon-user"></span>Modificar datos</a></li>
      <li><a href="#"><span class="icon-trash"></span>Darse de baja</a></li>
      <li><a href="#"><span class="icon-picture"></span>Visualizar álbumes</a></li>
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
