<?php
$titulo = "KeepMoments - Confirmación de estilo";
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/auth.php";
include "inc/conexion-db.php";

// Recuperar usuario autenticado
$idUsuario = $_SESSION['idUsuario'] ?? null;
$estiloSeleccionado = $_GET['estilo'] ?? null;

// Validar datos
if (!$idUsuario) {
    echo "<p>Error: No se encontró un usuario autenticado.</p>";
    exit;
}
if (!$estiloSeleccionado || !ctype_digit($estiloSeleccionado)) {
    echo "<p>Error: Selección de estilo no válida.</p>";
    exit;
}

// Actualizar el estilo en la base de datos
$sqlActualizarEstilo = "UPDATE `usuarios` SET `estilo` = ? WHERE `idUsuario` = ?";
$stmt = $conn->prepare($sqlActualizarEstilo);
if ($stmt) {
    $stmt->bind_param("ii", $estiloSeleccionado, $idUsuario);
    if ($stmt->execute()) {
        // Actualizar la sesión con el nuevo estilo
        $_SESSION['estilo'] = "estilo{$estiloSeleccionado}.css";

        echo "<main><h1>Estilo actualizado</h1>";
        echo "<p>Has seleccionado un nuevo estilo. ¡Disfruta de la experiencia personalizada!</p>";
        echo "<p><a href='configurar.php'>Volver a configuración</a></p>";
    } else {
        echo "<p>Error al actualizar el estilo: " . $stmt->error . "</p>";
    }
    $stmt->close();
} else {
    echo "<p>Error en la preparación de la consulta: " . $conn->error . "</p>";
}
echo "<pre>";
print_r($_SESSION);
echo "</pre>";


$conn->close();

?>
<p><a href="configurar.php">Volver a configuración</a></p>
</main>
<?php include "inc/pie.php"; include "inc/html-end.php"; ?>
