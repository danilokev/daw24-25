<?php
$titulo = "KeepMoments - Respuesta Datos";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/auth.php";
include "inc/conexion-db.php";

if (!isset($_SESSION['idUsuario']) || empty($_SESSION['idUsuario'])) {
    header("Location: index.html?error=ID de usuario no está definida");
    exit;
}

$idUsuario = $_SESSION['idUsuario'];

// Directorio de fotos de perfil
$directorioFotos = "fotos/usuarios/";

// Obtener datos del formulario
$usuario = $_POST['usu'] ?? '';
$pass = $_POST['pwd'] ?? '';
$repetirPass = $_POST['pwd2'] ?? '';
$email = $_POST['email'] ?? '';
$sexo = $_POST['genero'] ?? '';
$fNacimiento = $_POST['fnac'] ?? '';
$ciudad = $_POST['city'] ?? '';
$pais = $_POST['country'] ?? '';
$pwdActual = $_POST['pwd_actual'] ?? '';

// Consultar la contraseña actual
$sentenciaConfirmar = mysqli_prepare($conn, "SELECT clave, foto FROM usuarios WHERE idUsuario = ?");
mysqli_stmt_bind_param($sentenciaConfirmar, 'i', $idUsuario);
mysqli_stmt_execute($sentenciaConfirmar);
mysqli_stmt_bind_result($sentenciaConfirmar, $claveBD, $fotoActual);
mysqli_stmt_fetch($sentenciaConfirmar);
mysqli_stmt_close($sentenciaConfirmar);

// Verificar la contraseña actual
if (!password_verify($pwdActual, $claveBD)) {
    die("Error: la contraseña actual no es correcta");
}

// Si se ingresa una nueva contraseña
if (!empty($pass)) {
    if ($pass !== $repetirPass) {
        die("Error: Las nuevas contraseñas no coinciden");
    }
    $passHash = password_hash($pass, PASSWORD_DEFAULT);
} else {
    $passHash = $claveBD;
}

// Procesar foto de perfil
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $nombreOriginal = $_FILES['foto']['name'];
    $tipoArchivo = pathinfo($nombreOriginal, PATHINFO_EXTENSION);
    $nombreUnico = "{$idUsuario}_" . md5(uniqid(rand(), true)) . ".{$tipoArchivo}";
    $rutaDestino = $directorioFotos . $nombreUnico;

    // Mover el archivo al directorio
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
        // Eliminar foto anterior si existe
        if (!empty($fotoActual) && file_exists($directorioFotos . $fotoActual)) {
            unlink($directorioFotos . $fotoActual);
        }
        $fotoActual = $nombreUnico;
    } else {
        die("Error: No se pudo subir la foto de perfil");
    }
} elseif (isset($_POST['eliminar_foto'])) {
    // Eliminar foto actual si se seleccionó eliminar
    if (!empty($fotoActual) && file_exists($directorioFotos . $fotoActual)) {
        unlink($directorioFotos . $fotoActual);
    }
    $fotoActual = null;
}

// Validar que la foto se haya actualizado correctamente
if (!empty($fotoActual)) {
    if (!file_exists($directorioFotos . $fotoActual)) {
        die("Error: La foto no se encuentra en el servidor. Verifique permisos y ruta.");
    }
}

// Actualizar los datos del usuario
$sentencia = mysqli_prepare($conn, "UPDATE usuarios SET nomUsuario = ?, clave = ?, email = ?, sexo = ?, fNacimiento = ?, ciudad = ?, pais = ?, foto = ? WHERE idUsuario = ?");
mysqli_stmt_bind_param($sentencia, 'sssissisi', $usuario, $passHash, $email, $sexo, $fNacimiento, $ciudad, $pais, $fotoActual, $idUsuario);

if (!mysqli_stmt_execute($sentencia)) {
    die("Error: no se pudo realizar la actualización");
}

mysqli_stmt_close($sentencia);
mysqli_close($conn);

// Actualizar la cookie del nombre de usuario
setcookie("usu", $usuario, time() + 3600, "/");
?>
<main>
  <section>
    <h1>¡Tus datos han sido actualizados!</h1>
    <p>Estos son tus datos:</p>
    <ul>
      <li><strong>Nombre de usuario:</strong> <?= htmlspecialchars($usuario); ?></li>
      <li><strong>Correo electrónico:</strong> <?= htmlspecialchars($email); ?></li>
      <li><strong>Sexo:</strong> <?= htmlspecialchars($sexo); ?></li>
      <li><strong>Fecha de nacimiento:</strong> <?= htmlspecialchars($fNacimiento); ?></li>
      <li><strong>Ciudad:</strong> <?= htmlspecialchars($ciudad); ?></li>
      <li><strong>País:</strong> <?= htmlspecialchars($pais); ?></li>
      <li><strong>Foto de perfil:</strong> <?= $fotoActual ? "<img src=\"$directorioFotos$fotoActual\" alt=\"Foto de perfil\" style=\"max-width:100px;height:auto;\">" : "<span class=\"icon-user\"></span>"; ?></li>
    </ul>
  </section>
</main>
<?php
include "inc/pie.php";
include "inc/html-end.php";
?>