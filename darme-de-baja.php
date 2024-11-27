<?php
include "inc/html-start.php";
include "inc/cabecera.php";
include "inc/conexion-db.php";
include "inc/auth.php";
?>
    <main>
        <h1>¿Estás seguro de que quieres darte de baja?</h1>

        <form action="confirmar-baja.php" method="post">
            <input type="hidden" name="idUsuario" value="<?= $idUsuario; ?>">
            <label for="clave">Confirma tu contraseña:</label>
            <input type="password" id="clave" name="clave" required>
            <button type="submit">Confirmar baja</button>
            <a href="menu-usuario.php">Cancelar</a>
        </form>
    </main>

