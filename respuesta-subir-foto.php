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

if (empty($titulo)) {
  $errores['titulo'] = "El título es obligatorio.";
}

if (strlen($alternativo) < 10 || preg_match('/^(foto|imagen)/i', $alternativo)) {
  $errores['alternativo'] = "El texto alternativo debe tener al menos 10 caracteres y no comenzar con 'foto' o 'imagen'.";
}

if (!empty($errores)) {
  $_SESSION['errores'] = $errores;
  $_SESSION['datos'] = $_POST; // mantengo los datos ingresados
  header("Location: subir-foto.php");
  exit;
}

$sentencia = mysqli_prepare($conn, "INSERT INTO fotos (titulo, descripcion, fecha, pais, album, fichero, alternativo) VALUES (?, ?, ?, ?, ?, ?, ?)");

mysqli_stmt_bind_param($sentencia, 'sssiiss', $titulo, $descrip, $fecha, $pais, $album, $foto, $alternativo);

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
    <img src="foto/<?= htmlspecialchars($foto) ?>" alt="<?= htmlspecialchars($alternativo) ?>">
  </section>
</main>
<?php
include "inc/pie.php";
include "inc/html-end.php";
?>