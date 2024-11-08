<?php
  $titulo = "KeepMoments - Confirmación de solicitud de álbum impreso";
  include "inc/html-start.php";
  include "inc/cabecera.php";
?>
  <main>
    <h1>Confirmación de solicitud de álbum impreso</h1>
    <p class="text-album-impreso text-res-album">¡Gracias por solicitar tu álbum impreso en KeepMoments! A continuación, te mostramos los principales datos de tu
      solicitud:</p>
    <div id="container-main-res">
      <section class="container-respuesta">
        <h2>Detalles del Álbum</h2>
        <p><strong>Nombre:</strong><?= isset($_GET['nombre']) ? $_GET['nombre'] : 'N/A'; ?></p>
        <p><strong>Título del álbum:</strong> <?= $_GET['titulo']; ?></p>
        <p><strong>Texto adicional:</strong> Este álbum contiene los mejores momentos de nuestro viaje por Europa.</p>
        <p><strong>Correo electrónico:</strong> <?= isset($_GET['email']) ? $_GET[email] : 'N/A'; ?></p>
      </section>
  
      <section class="container-respuesta">
        <h2>Dirección de Envío</h2>
        <p><strong>Calle:</strong> <?= $_GET['calle']; ?></p>
        <p><strong>Número:</strong> <?= $_GET['numero']; ?></p>
        <p><strong>Piso:</strong> <?= $_GET['piso']; ?></p>
        <p><strong>Puerta:</strong> <?= $_GET['puerta']; ?></p>
        <p><strong>Código Postal:</strong> <?= $_GET['codigo_postal']; ?></p>
        <p><strong>Localidad:</strong> <?= $_GET['localidad']; ?></p>
        <p><strong>Provincia:</strong> <?= $_GET['provincia']; ?></p>
        <p><strong>País:</strong> <?= $_GET['pais']; ?></p>
      </section>
  
      <section class="container-respuesta">
        <h2>Configuración del Álbum</h2>
        <p><strong>Color de la portada:</strong><span id="color-portada"></span></p>
        <p><strong>Número de copias:</strong> 1</p>
        <p><strong>Resolución de las fotos:</strong> 300 dpi</p>
        <p><strong>Álbum seleccionado:</strong> <?= $_GET['album']; ?></p>
        <p><strong>Impresión a color:</strong> Sí</p>
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