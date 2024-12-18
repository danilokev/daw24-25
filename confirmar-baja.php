<?php
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/conexion-db.php";
include "inc/auth.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUsuario = $_SESSION['idUsuario']; // ID del usuario autenticado
    $clave = $_POST['clave'];

    // Obtener la contraseña almacenada del usuario
    $sqlClave = "SELECT clave FROM usuarios WHERE idUsuario = ?";
    $stmtClave = $conn->prepare($sqlClave);
    $stmtClave->bind_param("i", $idUsuario);

    if (!$stmtClave->execute()) {
        echo "Error en la consulta: " . $stmtClave->error;
        exit;
    }

    $resultClave = $stmtClave->get_result();
    $usuario = $resultClave->fetch_assoc();
    $stmtClave->close();

    if (!$usuario) {
        echo "<p>No se encontró el usuario con el ID especificado.</p>";
        exit;
    }

    // Comparar contraseñas utilizando password_verify()
    if (!password_verify($clave, $usuario['clave'])) {
        echo "<p>Contraseña incorrecta. No se puede realizar la baja.</p>";
        echo '<a href="darme-de-baja.php">Volver</a>';
        exit;
    }

    // Transacción para eliminar datos relacionados
    $conn->autocommit(false);
    try {
        // obtengo el fichero de las fotos del usuario
        $sqlFotos = "SELECT f.fichero FROM fotos f INNER JOIN albumes a ON f.album = a.idAlbum WHERE a.usuario = ?";
        $stmtFotos = $conn->prepare($sqlFotos);
        $stmtFotos->bind_param("i", $idUsuario);
        $stmtFotos->execute();
        $resultFotos = $stmtFotos->get_result();
        $fotos = $resultFotos->fetch_all(MYSQLI_ASSOC);
        $stmtFotos->close();

        // Eliminar solicitudes relacionadas con los álbumes del usuario
        $sqlEliminarSolicitudes = "DELETE s FROM solicitudes s INNER JOIN albumes a ON s.album = a.idAlbum WHERE a.usuario = ?";
        $stmtSolicitudes = $conn->prepare($sqlEliminarSolicitudes);
        $stmtSolicitudes->bind_param("i", $idUsuario);
        $stmtSolicitudes->execute();
        $stmtSolicitudes->close();

        // Eliminar fotos
        $sqlEliminarFotos = "DELETE f FROM fotos f INNER JOIN albumes a ON f.album = a.idAlbum WHERE a.usuario = ?";
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

        // Borrar los archivos de fotos 
        foreach ($fotos as $foto) {
            $rutaFoto = $foto['fichero'];
            if (file_exists($rutaFoto)) {
                unlink($rutaFoto);
            }
        }

        $conn->commit();
        $conn->autocommit(true);

        // Cerrar sesión
        include "salir.php";
        echo "<p>Tu cuenta ha sido eliminada correctamente.</p>";
    } catch (Exception $e) {
        $conn->rollback();
        echo "<p>Error al eliminar la cuenta: " . $e->getMessage() . "</p>";
        echo '<a href="menu-usuario.php">Volver</a>';
    }
}

$conn->close();