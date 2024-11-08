<?php
  $titulo = "KeepMoments - Confirmación de solicitud de álbum impreso";
  include "inc/html-start.php";
  $usuario_identificado = true;
  include "inc/cabecera.php";
?>
  <main>
    <h1>Confirmación de solicitud de álbum impreso</h1>
    <p class="text-album-impreso text-res-album">¡Gracias por solicitar tu álbum impreso en KeepMoments! A continuación, te mostramos los principales datos de tu
      solicitud:</p>
    <div id="container-main-res">
      <section class="container-respuesta">
        <h2>Detalles del Álbum</h2>
          <p><strong>Nombre:</strong><?= isset($_POST['nom']) ? $_POST['nom'] : 'N/A'; ?></p>
          <p><strong>Título del álbum:</strong> <?= $_POST['titulo']; ?></p>
          <p><strong>Texto adicional:</strong> <?= isset($_POST['texto']) ? $_POST['texto'] : 'N/A'; ?></p>
          <p><strong>Correo electrónico:</strong> <?= isset($_POST['email']) ? $_POST['email'] : 'N/A'; ?></p>

          <p><strong>Calle:</strong> <?= $_POST['calle']; ?></p>
          <p><strong>Número:</strong> <?= $_POST['numero']; ?></p>
          <p><strong>Piso:</strong> <?= $_POST['piso']; ?></p>
          <p><strong>Puerta:</strong> <?= $_POST['puerta']; ?></p>
          <p><strong>Código Postal:</strong> <?= $_POST['codigo_postal']; ?></p>
          <p><strong>Localidad:</strong> <?= $_POST['localidad']; ?></p>
          <p><strong>Provincia:</strong> <?= $_POST['provincia']; ?></p>
          <p><strong>País:</strong> <?= $_POST['pais']; ?></p>
          <p><strong>Álbum seleccionado:</strong> <?= $_POST['album']; ?></p>
          <p><strong>Impresión a color:</strong> <?= isset($_POST['impresion']) ? 'Sí' : 'No'; ?></p>

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