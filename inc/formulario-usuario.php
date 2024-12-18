<?php
$datos = $datos ?? []; // valores actuales de los campos
$errores = $errores ?? [];
?>
<form id="<?= $id ?? '#' ?>" action="<?= $action ?? '#' ?>" method="post" enctype="<?= $enctype ?? '#' ?>">
  <h1>KeepMoments</h1>
  <p class="form-info">Por favor, completa los datos requeridos.</p>
  <p class="form-input">
    <label for="usu"><span class="icon-doc-text"></span>Nombre de usuario:</label>
    <input type="text" name="usu" id="usu" value="<?= $datos['nomUsuario'] ?? '' ?>">
    <span class="error-message"><?= $errores['usu'] ?? '' ?></span>
  </p>
  <p class="form-input">
    <label for="pwd"><span class="icon-key"></span><?= $textoLabelPdw ?>:</label>
    <input type="password" name="pwd" id="pwd">
    <span class="error-message"><?= $errores['pwd'] ?? '' ?></span>
  </p>
  <p class="form-input">
    <label for="pwd2"><span class="icon-key"></span><?= $textoLabelPdw2 ?>:</label>
    <input type="password" name="pwd2" id="pwd2">
    <span class="error-message"><?= $errores['pwd2'] ?? '' ?></span>
  </p>
  <p class="form-input">
    <label for="email"><span class="icon-mail-alt"></span>Correo electrónico:</label>
    <input type="text" name="email" id="email" value="<?= $datos['email'] ?? '' ?>">
    <span class="error-message"><?= $errores['email'] ?? '' ?></span>
  </p>
  <p class="form-input">
    <label for="genero"><span class="icon-adult"></span>Sexo:</label>
    <select name="genero" id="genero">
      <option value="">--Elige una opción--</option>
      <option value="0" <?= (isset($datos['sexo']) && $datos['sexo'] == '0') ? 'selected' : '' ?>>Hombre</option>
      <option value="1" <?= (isset($datos['sexo']) && $datos['sexo'] == '1') ? 'selected' : '' ?>>Mujer</option>
      <option value="2" <?= (isset($datos['sexo']) && $datos['sexo'] == '2') ? 'selected' : '' ?>>Otro</option>
    </select>
    <span class="error-message"><?= $errores['genero'] ?? '' ?></span>
  </p>
  <p class="form-input">
    <label for="fnac"><span class="icon-calendar"></span>Fecha de nacimiento:</label>
    <input type="text" name="fnac" id="fnac" value="<?= $datos['fNacimiento'] ?? '' ?>">
    <span class="error-message"><?= $errores['fnac'] ?? '' ?></span>
  </p>
  <p class="form-input">
    <label for="city"><span class="icon-building"></span>Ciudad de residencia:</label>
    <input type="text" name="city" id="city" value="<?= $datos['ciudad'] ?? '' ?>">
  </p>
  <p class="form-input">
    <label for="country"><span class="icon-flag"></span>País de residencia:</label>
    <select name="country" id="country">
      <option value="">--Elige un país--</option>
      <?php foreach ($paises as $pais): ?>
        <option value="<?= $pais['idPais'] ?>"
          <?= (isset($datos['pais']) && $datos['pais'] == $pais['idPais']) ? 'selected' : '' ?>>
          <?= $pais['nomPais'] ?>
        </option>
      <?php endforeach; ?>
    </select>
  </p>
  <p class="form-input">
    <label for="foto"><span class="icon-camera"></span><?= $textoLabelPerfil ?>:</label>
    <input type="file" name="foto" id="foto" accept="image/*">
  </p>
  <p>
    <input class="btn" type="submit" value="<?= $botonTexto ?>">
  </p>
</form>