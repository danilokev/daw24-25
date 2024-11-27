<?php
session_start();
include "inc/conexion-db.php";
include "inc/auth.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUsuario = $_POST['idUsuario'];
    $clave = $_POST['clave'];

    // Obtener la contraseña almacenada del usuario
    $sqlClave = "SELECT clave FROM usuarios WHERE idUsuario = ?";
    $stmtClave = $conn->prepare($sqlClave);
    $stmtClave->bind_param("i", $idUsuario);
    $stmtClave->execute();
    $resultClave = $stmtClave->get_result();
    $usuario = $resultClave->fetch_assoc();
    $stmtClave->close();
    var_dump($clave); // Para verificar que la contraseña recibida es correcta
    var_dump(value: $usuario['clave']); // Para verificar la contraseña almacenada en la base de datos

    if (!$usuario || $clave !== $usuario['clave']) {
        echo "<p>Contraseña incorrecta. No se puede realizar la baja.</p>";
        echo '<a href="darme-de-baja.php">Volver</a>';
        exit;
    }

    // Eliminar datos relacionados con el usuario
    $conn->autocommit(false); // Iniciar transacción
    try {
        // Eliminar fotos
        $sqlEliminarFotos = "
            DELETE f 
            FROM fotos f 
            INNER JOIN albumes a ON f.album = a.idAlbum 
            WHERE a.usuario = ?";
        $stmtFotos = $conn->prepare($sqlEliminarFotos);
        $stmtFotos->bind_param("i", $idUsuario);
        $stmtFotos->execute();
        $stmtFotos->close();

        // Eliminar álbumes
        $sqlEliminarAlbumes = "DELETE FROM albumes WHERE usuario = ?";
        $stmtAlbumes = $conn->prepare($sqlEliminarAlbumes);
        $stmtAlbumes->bind_param("i", $idUsuario);
        $stmtAlbumes->execute();
        $stmtAlbumes->close();

        // Eliminar usuario
        $sqlEliminarUsuario = "DELETE FROM usuarios WHERE idUsuario = ?";
        $stmtUsuario = $conn->prepare($sqlEliminarUsuario);
        $stmtUsuario->bind_param("i", $idUsuario);
        $stmtUsuario->execute();
        $stmtUsuario->close();

        $conn->commit(); // Confirmar transacción
        $conn->autocommit(true);

        // Cerrar sesión
        session_destroy();
        echo "<p>Tu cuenta ha sido eliminada correctamente.</p>";
        echo '<a href="index.php">Volver al inicio</a>';
    } catch (Exception $e) {
        $conn->rollback(); // Revertir transacción en caso de error
        echo "<p>Error al eliminar la cuenta: " . $e->getMessage() . "</p>";
        echo '<a href="menu-usuario.php">Volver</a>';
    }
}

$conn->close();
?>
