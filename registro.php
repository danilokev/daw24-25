<?php
$titulo = "KeepMoments - Registro";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/conexion-db.php"; // Conexión a la base de datos

// Redirigir al menú de usuario si ya está identificado
if (isset($_SESSION['usuario']) || (isset($_COOKIE['usu']) && isset($_COOKIE['pwd']))) {
  header('Location: menu-usuario.php?notice=already_logged_in');
  exit;
}

$errores = $_GET['errores'] ?? [];

// Consulta para obtener los países de la base de datos
$sql = "SELECT IdPais, NomPais FROM Paises ORDER BY NomPais ASC";
$result = $conn->query($sql);

// Verificar si hay resultados
$paises = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $paises[] = $row;
    }
}

$conn->close();
?>

<main class="main-form">
  <form id="registrationForm" action="respuesta-registro.php" method="post">
    <h1>Únete a KeepMoments</h1>
    <p class="form-info">Registra tu cuenta.</p>
    <p class="form-input">
      <label for="usu"><span class="icon-doc-text"></span>Nombre de usuario:</label>
      <input type="text" name="usu" id="usu">
      <span class="error-message"><?= $errores['usu'] ?? '' ?></span>
    </p>
    <p class="form-input">
      <label for="pwd"><span class="icon-key"></span>Contraseña:</label>
      <input type="password" name="pwd" id="pwd">
      <span class="error-message"><?= $errores['pwd'] ?? '' ?></span>
    </p>
    <p class="form-input">
      <label for="pwd2"><span class="icon-key"></span>Repetir contraseña:</label>
      <input type="password" name="pwd2" id="pwd2">
      <span class="error-message"><?= $errores['pwd2'] ?? '' ?></span>
    </p>
    <p class="form-input">
      <label for="email"><span class="icon-mail-alt"></span>Correo electrónico:</label>
      <input type="text" name="email" id="email">
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
        <?php foreach ($paises as $pais): ?>
          <option value="<?= htmlspecialchars($pais['IdPais'], ENT_QUOTES, 'UTF-8'); ?>">
            <?= htmlspecialchars($pais['NomPais'], ENT_QUOTES, 'UTF-8'); ?>
          </option>
        <?php endforeach; ?>
      </select>
    </p>
    <p>
      <input class="btn" type="submit" value="Registrarse">
    </p>
    <p class="form-footer">¿Tienes ya una cuenta? <a href="login.html">Inicia sesión</a></p>
  </form>
</main>
<?php
include "inc/pie.php";
include "inc/html-end.php";
?>
