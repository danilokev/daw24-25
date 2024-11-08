<!-- 
  Archivo: menu-usuario.html
  En este archivo se muestra el menú de usuario identificado.

  Creado por: Kevin Danilo, Marcos López el 30/09/2024

  Historial de cambios:
  30/09/2024 - Creación del archivo
-->
<?php
  $titulo = "KeepMoments - Página principal";
  include "inc/html-start.php";
  $usuario_identificado = true;
  include "inc/cabecera.php";
?>
  <main>
    <h2>Menú de usuario</h2>
    <ul>
      <li><a href="#">Modificar datos</a></li>
      <li><a href="#">Darse de baja</a></li>
      <li><a href="#">Visualizar álbumes</a></li>
      <li><a href="crear-album.php">Crear álbum nuevo</a></li>
      <li><a href="solicitar-album.php">Solicitar álbum impreso</a></li>
      <li><a href="index.html">Salir</a></li>
    </ul>
  </main>

<?php
  include "inc/pie.php";
  include "inc/html-end.php";
?>