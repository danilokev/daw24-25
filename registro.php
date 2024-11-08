<?php
  $titulo = "KeepMoments - Registro";
  include "inc/html-start.php";
  include "inc/cabecera.php";
    
  $errores = $_GET['errores'] ?? [];
  $datos = $_GET['datos'] ?? [];
?>

  <main class="main-form">
  <form id="registrationForm" action="respuesta-registro.php" method="post">
      <h1>Únete a KeepMoments</h1>
      <p class="form-info">Registra tu cuenta.</p>
    
    <p class="form-input">
        <label for="usu">Nombre de usuario:</label>
        <input type="text" name="usu" id="usu" value="<?= htmlspecialchars($datos['usu'] ?? '') ?>">
        <span class="error"><?= $errores['usu'] ?? '' ?></span>
    </p>

    <p class="form-input">
        <label for="pwd">Contraseña:</label>
        <input type="password" name="pwd" id="pwd">
        <span class="error"><?= $errores['pwd'] ?? '' ?></span>
    </p>

    <p class="form-input">
        <label for="pwd2">Repetir contraseña:</label>
        <input type="password" name="pwd2" id="pwd2">
        <span class="error"><?= $errores['pwd2'] ?? '' ?></span>
    </p>

    <p class="form-input">
        <label for="email">Correo electrónico:</label>
        <input type="text" name="email" id="email" value="<?= htmlspecialchars($datos['email'] ?? '') ?>">
    </p>
      <p class="form-input">
        <label for="genero"><span class="icon-adult"></span>Sexo:</label>
        <select name="genero" id="genero">
          <option value="">--Elige una opción--</option>
          <option value="h">Hombre</option>
          <option value="m">Mujer</option>
          <option value="x">Otro</option>
        </select>
      </p>
      <p class="form-input">
        <label for="fnac"><span class="icon-calendar"></span>Fecha de nacimiento:</label>
        <input type="text" name="fnac" id="fnac">
      </p>
      <p class="form-input">
        <label for="city"><span class="icon-building"></span>Ciudad de residencia:</label>
        <input type="text" name="city" id="city">
      </p>
      <p class="form-input">
        <label for="country"><span class="icon-flag"></span>País de residencia:</label>
        <select name="country" id="country">
          <option value="">--Elige un país--</option>
          <option value="es">España</option>
          <option value="prt">Portugal</option>
          <option value="ita">Italia</option>
          <option value="fra">Francia</option>
          <option value="su">Suiza</option>
          <option value="mx">México</option>
          <option value="ar">Argentina</option>
          <option value="us">Estados Unidos</option>
          <option value="al">Alemania</option>
          <option value="other">Otro</option>
        </select>
      </p>
      <p>
        <input class="btn" type="submit" value="Registrarse">
      </p>
      <p class="form-footer">¿Tienes ya una cuenta? <a href="login.php">Inicia sesión</a></p>
    </form>
  </main>
<?php
  include "inc/pie.php";
  include "inc/html-end.php";
?>