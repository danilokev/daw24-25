function tablaCostes() {
  const container = document.getElementById('contenedor-tabla-coste');
  const table = document.createElement('table'); // Crear tabla
  const thead = document.createElement('thead'); // Crear encabezado
  const headerRow = document.createElement('tr'); // Crear fila de encabezado
  
  // Textos de encabezado, array de strings
  const headers = [
    'Número de páginas',
    'Número de fotos',
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
  
  // Crear cuerpo de la tabla
  const tbody = document.createElement('tbody');
  
  // Datos de entrada (páginas y fotos)
  const rows = [
    [1, 3], [2, 6], [3, 9], [4, 12], [5, 15],
    [6, 18], [7, 21], [8, 24], [9, 27], [10, 30],
    [11, 33], [12, 36], [13, 39], [14, 42], [15, 45]
  ];
  
  // Función para calcular coste por página según bloques
  function costePorPagina(numPaginas) {
    if (numPaginas < 5) return 2;     // devuelvo 2 si el número de páginas es menor a 5
    if (numPaginas <= 10) return 1.8; // devuelvo 1.8 si el número de páginas es menor o igual a 10
    return 1.6;                       // devuelvo 1.6 si el número de páginas es mayor a 10
  }
  
  // Crear filas con cálculos
  rows.forEach(([paginas, fotos]) => {
    const tr = document.createElement('tr'); // Crear fila
    
    // Añadir columnas de páginas y fotos
    const tdPaginas = document.createElement('td');
    tdPaginas.textContent = paginas;
    const tdFotos = document.createElement('td');
    tdFotos.textContent = fotos;
    tr.appendChild(tdPaginas);
    tr.appendChild(tdFotos);
    
    // Calcular costes para cada combinación
    const costeProcesamiento = 10;
    const costePaginas = costePorPagina(paginas) * paginas;
    
    // Calcular y añadir costes para cada columna, Array de objetos
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
        coste += fotos * 0.5; // Añadir coste por color
      }
      
      // Añadir coste por alta resolución si aplica
      if (altaRes) {
        coste += fotos * 0.2; // Añadir coste por resolución mayor a 300 dpi
      }
      
      td.textContent = coste.toFixed(2) + ' €'; // Formatear a 2 decimales
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