<?php
$titulo = "KeepMoments - Darse de baja";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/auth.php";
include "inc/conexion-db.php";
?>
<main>
  <h1>¿Estás seguro de que quieres actualizar tus datos?</h1>
  <form action="respuesta-datos.php" method="post">
    <input type="hidden" name="usu" value="<?= $_POST['usu'] ?>">
    <input type="hidden" name="pwd" value="<?= $_POST['pwd'] ?>">
    <input type="hidden" name="pwd2" value="<?= $_POST['pwd2'] ?>">
    <input type="hidden" name="email" value="<?= $_POST['email'] ?>">
    <input type="hidden" name="genero" value="<?= $_POST['genero'] ?>">
    <input type="hidden" name="fnac" value="<?= $_POST['fnac'] ?>">
    <input type="hidden" name="city" value="<?= $_POST['city'] ?>">
    <input type="hidden" name="country" value="<?= $_POST['country'] ?>">
    <input type="hidden" name="foto" value="<?= $_FILES['foto']['name'] ?>">
    <p class="form-input">
      <label for="pwd_actual">Contraseña actual:</label>
      <input type="password" id="pwd_actual" name="pwd_actual" required>
    </p>
    <button class="btn" type="submit">Confirmar</button>
  </form>
</main>
<?php
include "inc/pie.php";
include "inc/html-end.php";
?>