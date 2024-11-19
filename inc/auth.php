<!-- 
con este código impido que un usuario no identificado acceda a páginas para usuarios que han hecho login.
-->
<?php
if (!isset($_SESSION['usuario'])) {
  if (isset($_COOKIE['usu']) && isset($_COOKIE['pwd'])) {
    $usu = $_COOKIE['usu'];
    $pwd = $_COOKIE['pwd'];
    
    if (!empty($usu) && !empty($pwd)) {
      $_SESSION['usuario'] = $usu;
      header('Location: menu-usuario.php');
    } else {
      header('Location: login.php?error=not_authenticated');
      exit();
    }
  } else {
    header('Location: login.php?error=not_authenticated');
    exit();
  }
}