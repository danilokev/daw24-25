<?php
$titulo = "KeepMoments - Página principal";
include "inc/html-start.php";
include "inc/cabecera.php";

// Redirigo al menú de usuario si ya está identificado
if (isset($_SESSION['usuario']) || (isset($_COOKIE['usu']) && isset($_COOKIE['pwd']))) {
  header('Location: menu-usuario.php?notice=already_logged_in');
  exit;
}

$cookieUsu = isset($_COOKIE['usu']) ? $_COOKIE['usu'] : '';
$cookiePwd = isset($_COOKIE['pwd']) ? $_COOKIE['pwd'] : '';
?>
<main class="main-form">
  <form id="miForm" action="control-acceso.php" method="post">
    <h1>Iniciar Sesión</h1>
    <p class="form-info">Inicia sesión para explorar todo el contenido de nuestra web.</p>
    <p class="form-input">
      <label for="usu"><span class="icon-doc-text"></span>Nombre de usuario:</label>
      <input type="text" name="usu" id="usu" value="<?= $cookieUsu ?>">
      <span class="error-message" id="usernameError"></span>
    </p>
    <p class="form-input">
      <label for="pwd"><span class="icon-key"></span>Contraseña:</label>
      <input type="password" id="pwd" name="pwd" value="<?= $cookiePwd ?>">
      <span class="error-message" id="passwordError"></span>
    </p>
    <p class="form-input">
      <input type="checkbox" id="recuerdame" name="recuerdame" <?= $cookieUsu ? 'cheched' : ''; ?>>
      <label for="recuerdame">Recordar mis datos en este equipo</label>
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