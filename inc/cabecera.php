<?php
session_start();

if (isset($_SESSION['usuario'])) {
  $usuarioIdentificado = true;
} elseif (isset($_COOKIE['usu']) && isset($_COOKIE['pwd'])) {
  $_SESSION['usuario'] = $_COOKIE['usu'];
  $usuarioIdentificado = true;
} else {
  $usuarioIdentificado = false;
  unset($_SESSION['usuario']); 
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
    <input type="search" name="titulo" placeholder="Buscar...">
    <button class="btn-search" type="submit">Buscar</button>
  </form>
</header>