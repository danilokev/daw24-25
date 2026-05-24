function tablaCostes() {
  const container = document.getElementById('contenedor-tabla-coste');
  const table = document.createElement('table');  // Crear tabla
  const thead = document.createElement('thead');  // Crear encabezado
  const headerRow = document.createElement('tr'); // Crear fila de encabezado
  const tbody = document.createElement('tbody');  // Crear cuerpo de tabla

  // Textos de encabezado, array de strings
  const headers = [
    'Núm. de páginas',
    'Núm. de fotos',
    'Blanco y negro\n150-300 dpi',
    'Blanco y negro\n450-900 dpi',
    'Color\n150-300 dpi',
    'Color\n450-900 dpi'
  ];

  // Crear celdas de encabezado
  headers.forEach(text => {
    const th = document.createElement('th');
    th.textContent = text;
    headerRow.appendChild(th);
  });

  thead.appendChild(headerRow);
  table.appendChild(thead);

  // Datos de entrada [número páginas, número fotos]
  const rows = [
    [1, 3], [2, 6], [3, 9], [4, 12], [5, 15],
    [6, 18], [7, 21], [8, 24], [9, 27], [10, 30],
    [11, 33], [12, 36], [13, 39], [14, 42], [15, 45]
  ];

  // Función para calcular coste por página según bloques
  function costePorPaginas(numPaginas) {
    let costeTotal = 0;

    if (numPaginas <= 4) {
      // Todas las páginas a 2€
      costeTotal = numPaginas * 2;
    } else if (numPaginas <= 10) {
      // Primeras 4 páginas a 2€, resto a 1.8€
      costeTotal = (4 * 2) + ((numPaginas - 4) * 1.8);
    } else {
      // Primeras 4 páginas a 2€, siguientes 6 páginas a 1.8€, resto a 1.6€
      costeTotal = (4 * 2) + (6 * 1.8) + ((numPaginas - 10) * 1.6);
    }

    return costeTotal;
  }

  // Añado las filas a la tabla con sus respectivos costes
  rows.forEach(([paginas, fotos]) => {
    const tr = document.createElement('tr');
    const tdPaginas = document.createElement('td');
    const tdFotos = document.createElement('td');

    tdPaginas.textContent = paginas;
    tdFotos.textContent = fotos;

    tr.appendChild(tdPaginas);
    tr.appendChild(tdFotos);

    // Calcular costes para cada combinación
    const costeProcesamiento = 10;
    const costePaginas = costePorPaginas(paginas);

    // Calcular y añadir costes para cada columna
    const combinaciones = [
      { color: false, altaRes: false },
      { color: false, altaRes: true },
      { color: true, altaRes: false },
      { color: true, altaRes: true }
    ];

    combinaciones.forEach(({ color, altaRes }) => {
      const td = document.createElement('td');
      let coste = costeProcesamiento + costePaginas;

      // Añadir coste por color si aplica
      if (color) {
        coste += fotos * 0.5;
      }

      // Añadir coste por alta resolución si aplica
      if (altaRes) {
        coste += fotos * 0.2;
      }

      td.textContent = coste.toFixed(2) + ' €';
      tr.appendChild(td);
    });

    tbody.appendChild(tr);
  });

  table.appendChild(tbody);
  container.innerHTML = ''; // Limpiar contenedor
  container.appendChild(table);
}

function mostrarTabla() {
  document.getElementById('mostrar-tabla').addEventListener('click', () => {
    const tabla = document.getElementById('contenedor-tabla-coste');
    if (tabla.style.display === 'none') {
      tabla.style.display = 'block';
      tablaCostes(); // Generar tabla solo cuando se muestra
    } else {
      tabla.style.display = 'none';
    }
  });
}

document.addEventListener('DOMContentLoaded', () => {
  mostrarTabla();
});