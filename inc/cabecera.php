<header>
  <div>
    <label for="chkMenu">&equiv;</label>
    <input type="checkbox" name="menu" id="chkMenu">
    <a href="index.php"><img src="img/logo1.png" alt="logo"></a>
    <nav>
      <ul>
        <?php if ($usuario_identificado): ?>
          <li><a href="identificado.php"><span class="icon-home"></span>Inicio</a></li>
          <li><a href="busqueda.php"><span class="icon-search"></span>Buscador</a></li>
          <li><a href="menu-usuario.php"><span class="icon-user-circle"></span>Mi Cuenta</a></li>
        <?php else: ?>
          <li><a href="index.php"><span class="icon-home"></span>Inicio</a></li>
          <li><a href="registro.php"><span class="icon-user-plus"></span>Regístrate</a></li>
          <li><a href="login.php"><span class="icon-login"></span>Iniciar sesión</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
  <form action="resultado.php" id="form-search">
    <input type="search" placeholder="Buscar...">
    <button class="btn-search" type="submit">Buscar</button>
  </form>
</header>