<?php
if (isset($_SESSION['usuario'])) {
    $usuarioIdentificado = true;
    $idUsuario = $_SESSION['usuario']; // ID del usuario autenticado

    // Recuperar el estilo del usuario desde la base de datos
    $sqlEstiloUsuario = "SELECT `estilo` FROM `usuarios` WHERE `idUsuario` = ?";
    $stmt = $conn->prepare($sqlEstiloUsuario);

    if ($stmt) {
        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();
        $stmt->bind_result($estilo);
        $stmt->fetch();
        $stmt->close();
    }

    // Usar estilo por defecto si no hay un estilo seleccionado
    $estilo = $estilo ?? 1; // Estilo ID 1 es el predeterminado

} elseif (isset($_COOKIE['usu']) && isset($_COOKIE['pwd'])) {
    $_SESSION['usuario'] = $_COOKIE['usu'];
    $usuarioIdentificado = true;
} else {
    $usuarioIdentificado = false;
    unset($_SESSION['usuario']);
    $estilo = 1; // Estilo por defecto para usuarios no autenticados
}
?>
<header>
  <div>
    <label for="chkMenu">&equiv;</label>
    <input type="checkbox" name="menu" id="chkMenu">
    <a href="index.php"><img src="img/logo1.png" alt="logo"></a>
    <nav>
      <ul>
        <?php if ($usuarioIdentificado): ?>
          <li><a href="identificado.php"><span class="icon-home"></span>Inicio</a></li>
          <li><a href="menu-usuario.php"><span class="icon-user-circle"></span>Mi Cuenta</a></li>
        <?php else: ?>
          <li><a href="index.php"><span class="icon-home"></span>Inicio</a></li>
          <li><a href="registro.php"><span class="icon-user-plus"></span>Regístrate</a></li>
          <li><a href="login.php"><span class="icon-login"></span>Iniciar sesión</a></li>
        <?php endif; ?>
        <li><a href="busqueda.php"><span class="icon-search"></span>Buscador</a></li>
      </ul>
    </nav>
  </div>
  <form action="resultado.php" method="get" id="form-search">
    <input type="search" name="q" placeholder="Buscar..." required>
    <button class="btn-search" type="submit">Buscar</button>
</form>
</header>
