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
$usuario_identificado = false;
include "inc/cabecera.php";
?>
<!-- <script src="scripts/validar-login.js"></script> -->
<main class="main-form">
  <form id="miForm" action="control-acceso.php" method="post">
    <h1>Iniciar Sesión</h1>
    <p class="form-info">Inicia sesión para explorar todo el contenido de nuestra web.</p>
    <p class="form-input">
      <label for="usu"><span class="icon-doc-text"></span>Nombre de usuario:</label>
      <input type="text" name="usu" id="usu">
      <span class="error-message" id="usernameError"></span>
    </p>
    <p class="form-input">
      <label for="pwd"><span class="icon-key"></span>Contraseña:</label>
      <input type="password" id="pwd" name="pwd">
      <span class="error-message" id="passwordError"></span>
    </p>
    <p>
      <input class="btn" type="submit" value="Iniciar sesión">
    </p>
    <p class="form-footer">¿No tienes una cuenta? <a href="registro.php">Regístrate</a></p>
  </form>
</main>

<?php
include "inc/pie.php";
include "inc/html-end.php";
?>