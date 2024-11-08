<!-- 
  Archivo: login.html
  En este archivo se muestra el formulario de inicio de sesión de un usuario.

  Creado por: Kevin Danilo, Marcos López el 23/09/2024

  Historial de cambios:
  23/09/2024 - Creación del archivo
-->
<?php
  $titulo = "KeepMoments - Página principal";
  include "inc/html-start.php";
  include "inc/cabecera.php";
?>

  <main class="main-form">
    <form action="identificado.php">
      <h1>Iniciar Sesión</h1>
        <p class="form-info">Inicia sesión para explorar todo el contenido de nuestra web.</p>
        <p class="form-input">
          <label for="email"><span class="icon-mail-alt"></span>Correo electrónico:</label>
          <input type="text" name="email" id="email">
        </p>
        <p class="form-input">
          <label for="psw"><span class="icon-key"></span>Contraseña:</label>
          <input type="text" id="psw" name="psw">
        </p>
        <p>
          <input class="btn" type="submit" id="submit" name="submit" value="Iniciar sesión">
        </p>
        <p class="form-footer">¿No tienes una cuenta? <a href="registro.html">Regístrate</a></p>
    </form>
  </main>

<?php
  include "inc/pie.php";
  include "inc/html-end.php";
?>