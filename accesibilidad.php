<!-- 
  archivo: accesibilidad.html
  En este achivo se muestra la declaración sobre la accesibilidad de la página web.
-->
<?php 
$titulo = "KeepMoments - Respuesta Registro";
include "inc/html-start.php";
$usuario_identificado = false;
include "inc/cabecera.php";
?>
<main>
    <h1>Declaración de Accesibilidad</h1>
    <section>
      <h2>Etiquetado Semántico</h2>
      <p>Nuestro sitio web utiliza etiquetas semánticas HTML para asegurar que la estructura del contenido sea clara y comprensible. Se usan elementos como <code>&lt;header&gt;</code>, <code>&lt;nav&gt;</code>, <code>&lt;main&gt;</code>, y <code>&lt;footer&gt;</code> para definir las diferentes secciones de la página. Esto facilita la navegación tanto para usuarios de lectores de pantalla como para motores de búsqueda.</p>
    </section>
    <section>
      <h2>Texto Alternativo para Imágenes</h2>
      <p>Se proporciona texto alternativo (atributo <code>alt</code>) para todas las imágenes significativas en nuestro sitio web. Esto permite a los usuarios que utilizan tecnologías de asistencia comprender el contenido de las imágenes. Las imágenes decorativas no incluyen texto alternativo para evitar distracciones innecesarias.</p>
    </section>
    <section>
      <h2>Uso Correcto de los Colores</h2>
      <p>Para garantizar una buena legibilidad, hemos implementado un esquema de colores que cumple con las pautas de contraste recomendadas. En el modo de alto contraste, se utilizan colores brillantes para el texto y fondos oscuros para mejorar la visibilidad.</p>
    </section>
    <section>
      <h2>Activación de la Hoja de Estilo Accesible</h2>
      <p>Los usuarios pueden activar una hoja de estilo de alto contraste o con letras grandes desde las opciones del navegador. Estas opciones se encuentran en el menú del navegador  y se aplican automáticamente al seleccionar la preferencia.</p>
    </section>
    <section>
      <h2>Otras Características de Accesibilidad</h2>
      <p>Además de lo mencionado, hemos implementado las siguientes características:</p>
      <ul>
        <li>Los elementos interactivos, como botones y enlaces, tienen un enfoque visible cuando se navega con el teclado.</li>
        <li>Los formularios incluyen etiquetas descriptivas y mensajes de error claros.</li>
      </ul>
    </section>
</main>
<?php
include "inc/pie.php";
include "inc/html-end.php";
?>