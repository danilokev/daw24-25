<?php
$titulo = "KeepMoments - Confirmación de solicitud de álbum impreso";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/auth.php";

$impresion = $_POST['impresion'] ?? '0';

// se tiene que hacer el coste final del álbum calculado a partir de la solicitud del usuario (INCOMPLETO)
// leer la documentación de la práctica
$resolucion = $_POST['resolucion'];
$numPaginas = 5;
$numFotos = 15;
?>
<main>
  <h1>Confirmación de solicitud de álbum impreso</h1>
  <p class="text-album-impreso text-res-album">¡Gracias por solicitar tu álbum impreso en KeepMoments! A continuación, te mostramos los principales datos de tu
    solicitud:</p>
  <div id="container-main-res">
    <section class="container-respuesta">
      <h2>Detalles del Álbum</h2>
      <p><strong>Nombre:</strong><?= $_POST['nom'] ?></p>
      <p><strong>Título del álbum:</strong> <?= $_POST['titulo']; ?></p>
      <p><strong>Texto adicional:</strong> <?= $_POST['texto'] ?></p>
      <p><strong>Correo electrónico:</strong> <?= $_POST['email'] ?></p>

      <p><strong>Calle:</strong> <?= $_POST['calle']; ?></p>
      <p><strong>Número:</strong> <?= $_POST['numero']; ?></p>
      <p><strong>Piso:</strong> <?= $_POST['piso']; ?></p>
      <p><strong>Puerta:</strong> <?= $_POST['puerta']; ?></p>
      <p><strong>Código Postal:</strong> <?= $_POST['codigo_postal']; ?></p>
      <p><strong>Localidad:</strong> <?= $_POST['localidad']; ?></p>
      <p><strong>Provincia:</strong> <?= $_POST['provincia']; ?></p>
      <p><strong>País:</strong> <?= $_POST['pais']; ?></p>
      <p><strong>Álbum seleccionado:</strong> <?= $_POST['album']; ?></p>
      <p><strong>Impresión a color:</strong> <?= $impresion; ?></p>
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