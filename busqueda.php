<?php
$titulo = "KeepMoments - Página de búsqueda";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/conexion-db.php"; // Conexión a la base de datos

// Consulta para obtener los países de la base de datos
$sql = "SELECT IdPais, NomPais FROM Paises ORDER BY NomPais ASC";
$result = $conn->query($sql);

// Verificar si hay resultados
$paises = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $paises[] = $row;
    }
}

$conn->close();
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
                <?php foreach ($paises as $pais): ?>
                    <option value="<?= htmlspecialchars($pais['IdPais'], ENT_QUOTES, 'UTF-8'); ?>">
                        <?= htmlspecialchars($pais['NomPais'], ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                <?php endforeach; ?>
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
