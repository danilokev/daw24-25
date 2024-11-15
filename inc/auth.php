<!-- 
con este código impido que un usuario no identificado acceda a páginas para usuarios que han hecho login.
-->
<?php
// session_start();

if (!isset($_SESSION['usuario'])) {
  header('Location: login.php?error=not_authenticated');
  exit();
}