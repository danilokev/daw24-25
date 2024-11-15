<!-- 
    Archivo: busqueda.html
    En este archivo se muestra el formulario de búsqueda de fotos.

    Creado por: Kevin Danilo, Marcos López el 23/09/2024

    Historial de cambios:
    23/09/2024 - Creación del archivo
-->
<?php
$titulo = "KeepMoments - Página de búsqueda";
include "inc/html-start.php";
include "inc/cabecera.php";
?>

<main class="main-form">
    <form action="resultado.php" method="get">
        <h1>Búsqueda avanzada</h1>
        <p class="form-info">Busca fotos por título, fecha y país.</p>
        <p class="form-input">
            <label for="titulo"><span class="icon-doc-text"></span>Título:</label>
            <input type="text" id="titulo" name="titulo">
        </p>

        <p class="form-input">
            <label for="fecha"><span class="icon-calendar"></span>Fecha:</label>
            <input type="text" id="fecha" name="fecha">
        </p>

        <p class="form-input">
            <label for="country"><span class="icon-flag"></span>País:</label>
            <select name="country" id="country">
                <option value="">--Elige un país--</option>
                <option value="es">España</option>
                <option value="prt">Portugal</option>
                <option value="ita">Italia</option>
                <option value="fra">Francia</option>
                <option value="su">Suiza</option>
                <option value="mx">México</option>
                <option value="ar">Argentina</option>
                <option value="us">Estados Unidos</option>
                <option value="al">Alemania</option>
                <option value="other">Otro</option>
            </select>
        </p>

        <p class="form-input">
            <input class="btn" type="submit" value="Buscar">
        </p>
    </form>
</main>

<?php
include "inc/pie.php";
include "inc/html-end.php";
?>