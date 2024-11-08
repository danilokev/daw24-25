<?php
  $titulo = "KeepMoments - Página principal";
  include "inc/html-start.php";
  include "inc/cabecera.php";
?>
<main class="main-form">
    <form action="menu-usuario.php">
      <h1>Crea un nuevo álbum</h1>
      
      <p class="form-info">Crea tu álbum chulo.</p>
      <p class="form-input">
        <label for="titulo"><span class="icon-doc-text"></span>Título:</label>
        <input type="text" id="titulo" name="titulo">
      </p>

      <p class="form-input">
        <label for="fecha"><span class="icon-calendar"></span>Descripción:</label>
        <input type="text" id="descripcion" name="descripcion">
      </p>

      <p class="form-input">
        <input class="btn" type="submit" value="Crear">
      </p>
    </form>
  </main>
<?php
  include "inc/pie.php";
  include "inc/html-end.php";
?>