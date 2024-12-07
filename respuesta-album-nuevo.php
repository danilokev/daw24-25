<?php
$titulo = "KeepMoments - respuesta álbum creado";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/auth.php";
include "inc/conexion-db.php";

if (!isset($_SESSION['idUsuario']) || empty($_SESSION['idUsuario'])) {
  header("Location: index.html?error=ID de usuario no está definida");
  exit;
}

$idUsuario = $_SESSION['idUsuario'];

// Obtengo los datos del formulario
$titulo = $_POST['titulo'] ?? '';
$descrip = $_POST['descripcion'] ?? '';

if (empty($titulo)) {
  $errores['titulo'] = "El título es obligatorio.";
}

if (!empty($errores)) {
  $_SESSION['errores'] = $errores;
  $_SESSION['datos'] = $_POST; // mantengo los datos ingresados
  header("Location: crear-album.php");
  exit;
}

// hago la inserción a la base de datos
$sentencia = mysqli_prepare($conn, "INSERT INTO albumes (titulo, descripcion, usuario) VALUES (?, ?, ?)");

mysqli_stmt_bind_param($sentencia, 'ssi', $titulo, $descrip, $idUsuario);

if (!mysqli_stmt_execute($sentencia)) {
  die("Error: no se pudo realizar la inserción. " . mysqli_stmt_error($sentencia));
}
// obtengo el id del último albúm creado por el usuario. Lo paso como parámetro por URL
$sqlAlbum = "SELECT idAlbum FROM albumes WHERE usuario = $idUsuario ORDER BY idAlbum DESC LIMIT 1";

if (!($resultAlbum = $conn->query($sqlAlbum))) {
  echo "<p>Error al ejecutar la sentencia <b>$sqlAlbum</b>: " . $conn->error . "</p>";
  exit;
}

$album = $resultAlbum->fetch_assoc();

$resultAlbum->close();
mysqli_stmt_close($sentencia);
mysqli_close($conn);
?>
<main>
  <section>
    <h1>Inserción realizada, el nuevo álbum es:</h1>
    <p>Titulo: <?= htmlspecialchars($titulo) ?></p>
    <p>descripcion: <?= htmlspecialchars($descrip) ?></p>
    <p>Sube tu primera foto al álbum: <a href="subir-foto.php?id=<?= $album['idAlbum'] ?>">Subir foto</a>.</p>
  </section>
</main>
<?php
include "inc/pie.php";
include "inc/html-end.php";
?>