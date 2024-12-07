<?php
$titulo = "KeepMoments - Crea un nuevo álbum";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/auth.php";

$errores = $_SESSION['errores'] ?? [];
$datos = $_SESSION['datos'] ?? [];

// elimino solo las variables temporales
unset($_SESSION['errores'], $_SESSION['datos']);
?>
<main class="main-form">
  <form action="respuesta-album-nuevo.php" method="post">
    <h1>Crea un nuevo álbum</h1>
    <p class="form-info">Crea tu álbum chulo</p>
    <p class="form-input">
      <label for="titulo"><span class="icon-doc-text"></span>Título:</label>
      <input type="text" id="titulo" name="titulo">
      <?php if (isset($errores['titulo'])): ?>
        <span class="error-message"><?= htmlspecialchars($errores['titulo']) ?></span>
      <?php endif; ?>
    </p>
    <p class="form-input">
      <label for="descripcion"><span class="icon-calendar"></span>Descripción:</label>
      <textarea id="descripcion" name="descripcion" rows="4"></textarea>
    </p>
    <p class="form-input">
      <input class="btn" type="submit" value="Crear álbum">
    </p>
  </form>
</main>
<?php
include "inc/pie.php";
include "inc/html-end.php";
?>