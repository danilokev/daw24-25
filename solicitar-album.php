<?php
$titulo = "KeepMoments - Solicitar álbum impreso";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/auth.php";
include "inc/mensaje.php";
include "inc/conexion-db.php";

// Consulta para obtener los países de la base de datos
$sql = "SELECT idAlbum, titulo FROM albumes ORDER BY titulo ASC";
$result = $conn->query($sql);

// verificamos si hay resultados
$albumes = [];
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $albumes[] = $row;
  }
}

// consulta para paises
$sqlPaises = "SELECT * FROM paises";
$resultPaises = $conn->query($sqlPaises);

if (!$resultPaises) {
  die("Error: no se pudo mostrar el listado de países. " . $conn->error);
}

$conn->close();
?>
<main>
  <h1>Solicitar álbum impreso</h1>

  <?php if ($mensaje): ?>
    <h2><?= htmlspecialchars($mensaje) ?></h2>
  <?php endif; ?>

  <div class="container-text-impreso">
    <p class="text-album-impreso">Para solicitar un álbum impreso, por favor rellena el formulario a continuación. Asegúrate de completar todos los campos obligatorios marcados con (*). </p>
    <p class="text-album-impreso">Podrás personalizar tu álbum con un título, texto adicional, y elegir entre varias opciones de configuración como el color de la portada, el número de copias, y la resolución de las fotos.</p>
    <p class="text-album-impreso">También podrás seleccionar la fecha aproximada de recepción y si deseas la impresión en color o en blanco y negro. Una vez completado, haz clic en "Solicitar álbum" para enviar tu solicitud.</p>
  </div>

  <div id="container-table-form">
    <div>
      <table id="table-solicitar">
        <thead>
          <tr>
            <th>Concepto</th>
            <th>Tarifa</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Coste procesamiento y envió</td>
            <td>10€</td>
          </tr>
          <tr>
            <td>&lt; 5 páginas</td>
            <td>2€ por pág.</td>
          </tr>
          <tr>
            <td>entre 5 y 10 páginas</td>
            <td>1.8€ por pág.</td>
          </tr>
          <tr>
            <td>&gt; 10 páginas</td>
            <td>1.6€ por pág.</td>
          </tr>
          <tr>
            <td>Blanco y negro</td>
            <td>0€</td>
          </tr>
          <tr>
            <td>Color</td>
            <td>0.5€ por foto</td>
          </tr>
          <tr>
            <td>Resolución &le; 300 dpi</td>
            <td>0€ por foto</td>
          </tr>
          <tr>
            <td>Resolución &gt; 300 dpi</td>
            <td>0.2€ por foto</td>
          </tr>
        </tbody>
      </table>

      <button id="mostrar-tabla" class="btn" onclick="verTabla()">Ver posibles costes</button>
      <div id="contenedor-tabla-coste" style="display: none">
        <?php include 'inc/tabla.php'; ?>
      </div>
    </div>

    <form id="container-form-impreso" action="respuesta-album.php" method="POST">
      <p>Los campos marcados con un <abbr class="obligatorio" title="obligatorio">*</abbr> son obligatorios.</p>
      <fieldset>
        <legend>Datos Personales</legend>
        <p class="form-input">
          <label for="nombre">Nombre completo:<abbr class="obligatorio" title="obligatorio" aria-label="obligatorio">*</abbr></label>
          <input type="text" id="nombre" name="nom" maxlength="200" required>
        </p>
        <p class="form-input">
          <label for="email">Correo electrónico: <?= isset($_POST['email']) ? $_POST['email'] : ''; ?><abbr class="obligatorio" title="obligatorio"
              aria-label="obligatorio">*</abbr></label>
          <input type="email" id="email" name="email" maxlength="200" required>
        </p>
        <p class="form-input">
          <label for="telefono">Teléfono:</label>
          <input type="tel" id="telefono" name="telefono">
        </p>
      </fieldset>

      <fieldset>
        <legend>Detalles del Álbum</legend>
        <p class="form-input">
          <label for="titulo">Título del álbum:<abbr class="obligatorio" title="obligatorio" aria-label="obligatorio">*</abbr></label>
          <input type="text" id="titulo" name="titulo" maxlength="200" required>
        </p>
        <p class="form-input">
          <label for="texto">Texto adicional:</label>
          <textarea id="texto" name="texto" maxlength="4000"></textarea>
        </p>
      </fieldset>

      <fieldset>
        <legend>Dirección de Envío</legend>
        <p class="form-input">
          <label for="calle">Calle:<abbr class="obligatorio" title="obligatorio" aria-label="obligatorio">*</abbr></label>
          <input type="text" id="calle" name="calle" required>
        </p>
        <p class="form-input">
          <label for="numero">Número:<abbr class="obligatorio" title="obligatorio"
              aria-label="obligatorio">*</abbr></label>
          <input type="number" id="numero" name="numero" required>
        </p>
        <p class="form-input">
          <label for="piso">Piso:<abbr class="obligatorio" title="obligatorio"
              aria-label="obligatorio">*</abbr></label>
          <input type="number" id="piso" name="piso" required>
        </p>
        <p class="form-input">
          <label for="puerta">Puerta:<abbr class="obligatorio" title="obligatorio"
              aria-label="obligatorio">*</abbr></label>
          <input type="text" id="puerta" name="puerta" required>
        </p>
        <p class="form-input">
          <label for="codp">Código Postal:<abbr class="obligatorio" title="obligatorio" aria-label="obligatorio">*</abbr></label>
          <input type="number" id="codp" name="codigo_postal" required>
        </p>
        <p class="form-input">
          <label for="localidad">Localidad:<abbr class="obligatorio" title="obligatorio" aria-label="obligatorio">*</abbr></label>
          <input type="text" id="localidad" name="localidad" required>
        </p>
        <p class="form-input">
          <label for="provincia">Provincia:<abbr class="obligatorio" title="obligatorio" aria-label="obligatorio">*</abbr></label>
          <input type="text" id="provincia" name="provincia" required>
        </p>
        <p class="form-input">
          <label for="pais">País:<abbr class="obligatorio" title="obligatorio" aria-label="obligatorio">*</abbr></label>
          <select name="pais" id="pais" required>
            <?php if ($resultPaises->num_rows > 0): ?>
              <?php while ($pais = $resultPaises->fetch_assoc()): ?>
                <option value="<?= htmlspecialchars($pais['idPais']) ?>">
                  <?= htmlspecialchars($pais['nomPais']) ?>
                </option>
              <?php endwhile; ?>
            <?php endif; ?>
          </select>
        </p>
      </fieldset>

      <fieldset>
        <legend>Configuración del álbum</legend>
        <p class="form-input">
          <label for="color-impreso">Color de la portada:</label>
          <input type="color" id="color-impreso" name="color" value="#000000">
        </p>
        <p class="form-input">
          <label for="copias">Número de copias:</label>
          <input type="number" id="copias" name="copias" min="1" max="99" value="1">
        </p>
        <p class="form-input">
          <label for="resolucion">Resolución de las fotos:</label>
          <input type="range" id="resolucion" name="resolucion" min="150" max="900" step="150" value="150"
            onchange="document.getElementById('outvol').value=value">
          <output id="outvol" name="outvol" for="resolucion">150</output><span id="outvol-span"> dpi</span>
        </p>
        <p class="form-input">
          <label for="album">Álbum de fotos:<abbr class="obligatorio" title="obligatorio" aria-label="obligatorio">*</abbr></label>
          <select id="album" name="album" required>
            <option value="">--Elige un Album--</option>
            <?php foreach ($albumes as $album): ?>
              <option value="<?= htmlspecialchars($album['idAlbum'], ENT_QUOTES, 'UTF-8'); ?>">
                <?= htmlspecialchars($album['titulo'], ENT_QUOTES, 'UTF-8'); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </p>
        <p class="form-input">
          <label for="fecha">Fecha de recepción:</label>
          <input type="date" id="fecha" name="fecha">
        </p>
        <p id="impresion-color">
          <label for="impresion">Impresión a color:</label>
          <input type="checkbox" id="impresion" name="impresion" value="1">
        </p>
      </fieldset>
      <p>
        <input class="btn" type="submit" value="Solicitar álbum">
      </p>
    </form>
  </div>
</main>
<script>
  function verTabla() {
    const tabla = document.getElementById('contenedor-tabla-coste');
    if (tabla.style.display === 'none') {
      tabla.style.display = 'block';
    } else {
      tabla.style.display = 'none';
    }
  }
</script>
<?php
include "inc/pie.php";
include "inc/html-end.php";
?>