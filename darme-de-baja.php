<?php
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/conexion-db.php";
include "inc/auth.php";

$idUsuario = $_SESSION['idUsuario'];

// Obtener el resumen de álbumes y fotos
$sqlResumen = "
    SELECT 
        a.idAlbum, 
        a.titulo, 
        COUNT(f.idFoto) AS numFotos
    FROM albumes a
    LEFT JOIN fotos f ON a.idAlbum = f.album
    WHERE a.usuario = ?
    GROUP BY a.idAlbum, a.titulo";

$stmtResumen = $conn->prepare($sqlResumen);
$stmtResumen->bind_param("i", $idUsuario);
$stmtResumen->execute();
$resultResumen = $stmtResumen->get_result();

$albumes = [];
$totalFotos = 0;

while ($row = $resultResumen->fetch_assoc()) {
    $albumes[] = $row;
    $totalFotos += $row['numFotos'];
}

$stmtResumen->close();

?>
<main>
    <h1>Confirmación de baja</h1>
    <p>Estos son tus álbumes y fotos registrados:</p>
    <table>
        <thead>
            <tr>
                <th>Álbum</th>
                <th>Número de Fotos</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($albumes as $album): ?>
                <tr>
                    <td><?= htmlspecialchars($album['titulo']); ?></td>
                    <td><?= htmlspecialchars($album['numFotos']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p><strong>Total de fotos:</strong> <?= $totalFotos; ?></p>
    <form action="confirmar-baja.php" method="post">
        <label for="clave">Confirma tu contraseña:</label>
        <input type="password" id="clave" name="clave" required>
        <button type="submit">Confirmar baja</button>
        <a href="menu-usuario.php">Cancelar</a>
    </form>
    <a href="menu-usuario.php">Cancelar</a>
</main>
<?php
$conn->close();
include "inc/html-end.php";
?>



