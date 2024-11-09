<?php
// Función para calcular el coste según el número de páginas
function costePorPaginas($numPaginas)
{
  $costeTotal = 0;

  if ($numPaginas <= 4) {
    // Todas las páginas a 2€
    $costeTotal = $numPaginas * 2;
  } elseif ($numPaginas <= 10) {
    // Primeras 4 páginas a 2€, resto a 1.8€
    $costeTotal = (4 * 2) + (($numPaginas - 4) * 1.8);
  } else {
    // Primeras 4 páginas a 2€, siguientes 6 páginas a 1.8€, resto a 1.6€
    $costeTotal = (4 * 2) + (6 * 1.8) + (($numPaginas - 10) * 1.6);
  }

  return $costeTotal;
}

// Función para generar la tabla completa de costes
function generarTablaCostes()
{
  $headers = [
    'Núm. de páginas',
    'Núm. de fotos',
    'Blanco y negro (150-300 dpi)',
    'Blanco y negro (450-900 dpi)',
    'Color (150-300 dpi)',
    'Color (450-900 dpi)'
  ];

  // Datos de entrada para filas (número de páginas, número de fotos)
  $rows = [
    [1, 3],
    [2, 6],
    [3, 9],
    [4, 12],
    [5, 15],
    [6, 18],
    [7, 21],
    [8, 24],
    [9, 27],
    [10, 30],
    [11, 33],
    [12, 36],
    [13, 39],
    [14, 42],
    [15, 45]
  ];

  $tablaHTML = "<table>";
  // Crear encabezados
  $tablaHTML .= "<thead><tr>";
  foreach ($headers as $header) {
    $tablaHTML .= "<th>$header</th>";
  }
  $tablaHTML .= "</tr></thead>";

  // Crear cuerpo de la tabla
  $tablaHTML .= "<tbody>";
  foreach ($rows as $row) {
    list($paginas, $fotos) = $row;

    $tablaHTML .= "<tr>";
    $tablaHTML .= "<td>$paginas</td>";
    $tablaHTML .= "<td>$fotos</td>";

    $costeProcesamiento = 10;
    $costePaginas = costePorPaginas($paginas);

    // Definir combinaciones de color y resolución
    $combinaciones = [
      ['color' => false, 'altaRes' => false],
      ['color' => false, 'altaRes' => true],
      ['color' => true, 'altaRes' => false],
      ['color' => true, 'altaRes' => true]
    ];

    // Generar columnas de coste para cada combinación
    foreach ($combinaciones as $combinacion) {
      $coste = $costeProcesamiento + $costePaginas;

      // Añadir coste por color si aplica
      if ($combinacion['color']) {
        $coste += $fotos * 0.5;
      }

      // Añadir coste por alta resolución si aplica
      if ($combinacion['altaRes']) {
        $coste += $fotos * 0.2;
      }

      $tablaHTML .= "<td>" . number_format($coste, 2) . " €</td>";
    }

    $tablaHTML .= "</tr>";
  }
  $tablaHTML .= "</tbody></table>";

  return $tablaHTML;
}

echo generarTablaCostes();
