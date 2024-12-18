<?php
$titulo = "KeepMoments - respuesta subir nueva foto";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/auth.php";
include "inc/conexion-db.php";

// recogo los datos del formulario
$titulo = $_POST['titulo'] ?? '';
$descrip = $_POST['descripcion'] ?? '';
$fecha = $_POST['fecha'] ?? '';
$pais = $_POST['pais'] ?? '';
$album = $_POST['album'] ?? '';
$alternativo = $_POST['alternativo'] ?? '';
$foto = basename($_FILES['foto']['name']);

define("UPLOAD_DIR", "fotos/");

if (empty($titulo)) {
  $errores['titulo'] = "El título es obligatorio.";
}

if (strlen($alternativo) < 10 || preg_match('/^(foto|imagen)/i', $alternativo)) {
  $errores['alternativo'] = "El texto alternativo debe tener al menos 10 caracteres y no comenzar con 'foto' o 'imagen'.";
}

if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
  $errores['foto'] = "Debe seleccionar una foto válida.";
} else {
  $fileType = mime_content_type($_FILES['foto']['tmp_name']);
  $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

  if (!in_array($fileType, $allowedTypes)) {
      $errores['foto'] = "El archivo debe ser una imagen (jpg, png o gif).";
  }
}

if (!empty($errores)) {
  $_SESSION['errores'] = $errores;
  $_SESSION['datos'] = $_POST; // mantengo los datos ingresados
  header("Location: subir-foto.php");
  exit;
}

// Evitar colisiones de nombres de archivos
$userId = $_SESSION['idUsuario']; 
$extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
$uniqueName = $userId . "_" . $album . "_" . time() . "_" . bin2hex(random_bytes(5)) . "." . $extension;
$filePath = UPLOAD_DIR . $uniqueName;

// Mover el archivo al directorio de fotos
if (!move_uploaded_file($_FILES['foto']['tmp_name'], $filePath)) {
    die("Error al mover el archivo subido.");
}

$sentencia = mysqli_prepare($conn, "INSERT INTO fotos (titulo, descripcion, fecha, pais, album, fichero, alternativo) VALUES (?, ?, ?, ?, ?, ?, ?)");

mysqli_stmt_bind_param($sentencia, 'sssiiss', $titulo, $descrip, $fecha, $pais, $album, $uniqueName, $alternativo);

if (!mysqli_stmt_execute($sentencia)) {
  die("Error: no se pudo realizar la sentencia. " . mysqli_stmt_error($sentencia));
}

mysqli_stmt_close($sentencia);
mysqli_close($conn);
?>
<main>
  <section>
    <h1>Inserción realizada, la nueva foto es:</h1>
    <p>Titulo: <?= htmlspecialchars($titulo) ?></p>
    <p>Fecha: <?= htmlspecialchars($fecha) ?></p>
    <p>Pais: <?= htmlspecialchars($pais) ?></p>
    <img src="fotos/<?= htmlspecialchars($uniqueName) ?>" alt="<?= htmlspecialchars($alternativo) ?>">
  </section>
</main>
<?php
include "inc/pie.php";
include "inc/html-end.php";
?>