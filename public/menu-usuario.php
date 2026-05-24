<?php
$titulo = "KeepMoments - Menú de usuario";
include __DIR__ . "/../inc/html-start.php";
include __DIR__ . "/../inc/cabecera.php";
include __DIR__ . "/../inc/auth.php";
include __DIR__ . "/../inc/saludo.php";
include __DIR__ . "/../inc/mensaje.php";
$idUsuario = $_SESSION['usuario']; // O de otra manera, si se pasa desde un formulario

// Verifica si el idUsuario está correctamente asignado
// var_dump(value: $idUsuario);

?>
<main>
  <h1><?= $saludo . ' ' . $nombreUsuario ?></h1>
  
  <?php if ($mensaje): ?>
    <h2><?= $mensaje ?></h2>
  <?php endif; ?>

  <div id="menu-usu">
    <ul>
      <li><a href="mis-datos.php"><span class="icon-user"></span>Mis datos</a></li>
      <li><a href="mis-albumes.php"><span class="icon-picture"></span>Mis álbumes</a></li>
      <li><a href="crear-album.php"><span class="icon-plus"></span>Crear álbum nuevo</a></li>
      <li><a href="subir-foto.php"><span class="icon-plus"></span>Subir una foto</a></li>
      <li><a href="solicitar-album.php"><span class="icon-print"></span>Solicitar álbum impreso</a></li>
      <li><a href="darme-de-baja.php"><span class="icon-trash"></span>Darse de baja</a></li>
      <li><a href="configurar.php"><span class="icon-user"></span>Configuración</a></li>
      <li><a href="salir.php"><span class="icon-logout"></span>Salir</a></li>
    </ul>
  </div>
</main>
<?php
include __DIR__ . "/../inc/pie.php";
include __DIR__ . "/../inc/html-end.php";
?>