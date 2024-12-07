<?php
$titulo = "KeepMoments - Confirmación de solicitud de álbum impreso";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/auth.php";
include "inc/conexion-db.php";

// obtengo los datos del formulario
$nom = $_POST['nom'] ?? '';
$email = $_POST['email'] ?? '';
$telefono = $_POST['nom'] ?? '';
$titulo = $_POST['titulo'] ?? '';
$descrip = $_POST['texto'] ?? '';
$calle = $_POST['calle'] ?? '';
$numero = $_POST['numero'] ?? '';
$piso = $_POST['piso'] ?? '';
$puerta = $_POST['puerta'] ?? '';
$codigo_postal = $_POST['codigo_postal'] ?? '';
$localidad = $_POST['localidad'] ?? '';
$provincia = $_POST['provincia'] ?? '';
$pais = $_POST['pais'] ?? '';
$color = $_POST['color'] ?? '';
$copias = $_POST['copias'] ?? '';
$resolucion = $_POST['resolucion'] ?? '';
$album = $_POST['album'] ?? '';
$fecha = $_POST['fecha'] ?? '';
$impresion = isset($_POST['impresion']) ? 1 : 0;

$sentencia = mysqli_prepare($conn, "INSERT INTO solicitudes (album, nombre, titulo, descripcion, email, calle, numero, piso, puerta, codigoPostal, localidad, provincia, pais, telefono, color, copias, resolucion, fecha, iColor) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

mysqli_stmt_bind_param($sentencia, 'isssssiisississiisi', $album, $nom, $titulo, $descrip, $email, $calle, $numero, $piso, $puerta, $codigo_postal, $localidad, $provincia, $pais, $telefono, $color, $copias, $resolucion, $fecha, $impresion);

if (!mysqli_stmt_execute($sentencia)) {
  die("ERROR: no se pudo realizar la inserción. " . mysqli_stmt_error($sentencia));
}

mysqli_stmt_close($sentencia);
mysqli_close($conn);
?>
<main>
  <h1>Confirmación de solicitud de álbum impreso</h1>
  <p class="text-album-impreso text-res-album">¡Gracias por solicitar tu álbum impreso en KeepMoments! A continuación, te mostramos los principales datos de tu solicitud:</p>
  <div id="container-main-res">
    <section class="container-respuesta">
      <h2>Detalles del Álbum</h2>
      <p><strong>Nombre:</strong><?= htmlspecialchars($nom) ?></p>
      <p><strong>Título del álbum:</strong> <?= htmlspecialchars($titulo) ?></p>
      <p><strong>Texto adicional:</strong> <?= htmlspecialchars($descrip) ?></p>
      <p><strong>Correo electrónico:</strong> <?= htmlspecialchars($email) ?></p>
      <p><strong>Calle:</strong> <?= htmlspecialchars($calle) ?></p>
      <p><strong>Número:</strong> <?= htmlspecialchars($numero) ?></p>
      <p><strong>Piso:</strong> <?= htmlspecialchars($piso) ?></p>
      <p><strong>Puerta:</strong> <?= htmlspecialchars($puerta) ?></p>
      <p><strong>Código Postal:</strong> <?= htmlspecialchars($codigo_postal) ?></p>
      <p><strong>Localidad:</strong> <?= htmlspecialchars($localidad) ?></p>
      <p><strong>Provincia:</strong> <?= htmlspecialchars($provincia) ?></p>
      <p><strong>País:</strong> <?= htmlspecialchars($pais) ?></p>
      <p><strong>Álbum seleccionado:</strong> <?= htmlspecialchars($album) ?></p>
      <p><strong>Impresión a color:</strong> <?= htmlspecialchars($impresion) ?></p>
    </section>

    <section class="container-respuesta">
      <h2>Coste del Álbum</h2>
      <table>
        <thead>
          <tr>
            <th>Concepto</th>
            <th>Coste</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Procesamiento y envío</td>
            <td>10€</td>
          </tr>
          <tr>
            <td>Número de páginas</td>
            <td>10</td>
          </tr>
          <tr>
            <td>Precio por página</td>
            <td>1.8€ por página</td>
          </tr>
          <tr>
            <td>Fotos en color</td>
            <td>0.5€ por foto</td>
          </tr>
          <tr>
            <td>Resolución > 300 dpi</td>
            <td>0.2€ por foto</td>
          </tr>
          <tr>
            <td><strong>Total</strong></td>
            <td><strong>35€</strong></td>
          </tr>
        </tbody>
      </table>
    </section>
  </div>
</main>
<?php
include "inc/pie.php";
include "inc/html-end.php";
?>