<?php
$titulo = "KeepMoments - Respuesta Registro";
include "inc/html-start.php";
include "inc/cabecera.php";

// almacenamos los datos del formulario y si no hay datos, asignamos un valor por defecto
$usuario = $_POST['usu'] ?? '';
$password = $_POST['pwd'] ?? '';
$repetirPassword = $_POST['pwd2'] ?? '';
$email = $_POST['email'] ?? '';
$genero = $_POST['genero'] ?? '';
$fnac = $_POST['fnac'] ?? '';
$city = $_POST['city'] ?? '';
$country = $_POST['country'] ?? '';
$foto = basename($_FILES['foto']['name']);

$errores = []; // Variable para errores

// si los campos están vacíos, añadimos un mensaje de error
if (empty($usuario)) {
  $errores['usu'] = "El nombre de usuario es obligatorio.";
} elseif (!preg_match('/^[a-zA-Z][a-zA-Z0-9]{2,14}$/', $usuario)) { //Expresion Regular
  $errores['usu'] = "Debe comenzar con una letra, contener solo letras/números, y tener entre 3 y 15 caracteres.";
}

if (empty($password)) {
  $errores['pwd'] = "La contraseña es obligatoria.";
} elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d_-]{6,15}$/', $password)) {
  $errores['pwd'] = "La contraseña debe tener al menos una letra mayúscula, una minúscula, un número y entre 6 y 15 caracteres.";
}

if (empty($repetirPassword)) {
  $errores['pwd2'] = "Repetir la contraseña es obligatorio.";
} elseif ($password !== $repetirPassword) {
  $errores['pwd2'] = "Las contraseñas no coinciden.";
}

if (empty($email)) { //Filtro
  $errores['email'] = "El correo electrónico es obligatorio.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errores['email'] = "El formato del correo electrónico no es válido.";
}

if ($genero === '') {
  $errores['genero'] = "Debes seleccionar un género.";
}

if (empty($fnac)) {
  $errores['fnac'] = "Debes seleccionar una Fecha de nacimiento.";
} elseif (!empty($fnac)) {
  // Comprobar el formato con una expresión regular
  if (!preg_match('/^(\d{4})\/(\d{2})\/(\d{2})$/', $fnac, $matches)) {
    $errores['fnac'] = "El formato de la fecha debe ser yyyy/mm/dd.";
  } else {
    // Extraer día, mes y año
    $dia = (int)$matches[3];
    $mes = (int)$matches[2];
    $anio = (int)$matches[1];

    // Validar valores de día, mes y año
    $fechaValida = checkdate($mes, $dia, $anio);
    if (!$fechaValida) {
      $errores['fnac'] = "La fecha ingresada no es válida.";
    } else {
      // Comprobar que el usuario tenga al menos 18 años
      $edad = (int)date('Y') - $anio;
      if ((int)date('m') < $mes || ((int)date('m') == $mes && (int)date('d') < $dia)) {
        $edad--; // Aún no cumplió años este año
      }
      if ($edad < 18) {
        $errores['fnac'] = "Debes tener al menos 18 años.";
      }
    }
  }
}
// Procesar la subida de la foto
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
  $directorioDestino = 'fotos/usuarios/';

  // Crear el directorio si no existe
  if (!file_exists($directorioDestino)) {
    mkdir($directorioDestino, 0755, true);
  }

  // Generar un nombre único para la foto
  $nombreUnico = uniqid() . "_" . basename($_FILES['foto']['name']);
  $rutaDestino = $directorioDestino . $nombreUnico;

  // Mover la foto al directorio de destino
  if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
    $foto = $nombreUnico; // Guardar el nombre del archivo subido
  } else {
    $foto = null; // Si no se puede subir, asigna null
  }
} else {
  $foto = null; // Si no se subió archivo, asigna null
}
// verificamos si hay errores
if (!empty($errores)) {
  // Si hay errores, redirige al formulario con mensajes de error en la URL
  $errorString = http_build_query(['errores' => $errores]);
  header("Location: registro.php?$errorString");
  exit;
}

// Generar el hash de la contraseña
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Preparar la consulta
$stmt = $conn->prepare("INSERT INTO usuarios (nomUsuario, clave, email, sexo, fNacimiento, ciudad, pais, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

// Asignar los valores a los parámetros
$stmt->bind_param("sssissis", $usuario, $passwordHash, $email, $genero, $fnac, $city, $country, $foto);

// Ejecutar la consulta
if ($stmt->execute()) {
  // Registro exitoso
  echo "Usuario registrado exitosamente.";
} else {
  // Manejar el error
  echo "Error al registrar el usuario: " . $stmt->error;
}
// Cerrar la declaración
$stmt->close();

// Verificamos si hay errores
if (!empty($errores)) {
  // Si hay errores, redirigir al formulario con los mensajes de error
  $errorString = http_build_query(['errores' => $errores]);
  header("Location: registro.php?$errorString");
  exit;
}

// Cerrar la conexión
$conn->close();

?>
<main>
  <section id="res-registro">
    <h1>Datos Registrados</h1>
    <p><strong>Usuario:</strong> <?= $usuario; ?></p>
    <p><strong>Correo Electrónico:</strong> <?= $email; ?></p>
    <p><strong>Género:</strong> <?= $genero; ?></p>
    <p><strong>Fecha de Nacimiento:</strong> <?= $fnac; ?></p>
    <p><strong>Ciudad:</strong> <?= $city; ?></p>
    <p><strong>País:</strong> <?= $country; ?></p>
    <p><strong>Foto de perfil:</strong></p>
    <?php if ($foto && $foto !== '/fotos/foto1.jpg'): ?>
      <img src="fotos/usuarios/<?= htmlspecialchars($foto); ?>" alt="Foto de perfil">
    <?php else: ?>
      <img src="fotos/default/user-icon.png" alt="Icono de usuario">
    <?php endif; ?>


    <p><a href="login.php">Ir a login</a></p>
  </section>
</main>
<?php
include "inc/pie.php";
include "inc/html-end.php";
?>