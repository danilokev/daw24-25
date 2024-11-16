<?php
session_start();

$_SESSION = array();

if (isset($_COOKIE[session_name()])) {
  setcookie(session_name(), '', time() - 42000, '/');
}

if (isset($_COOKIE['usu'])) {
  setcookie('usu', '', time() - 3600, '/');
}

if (isset($_COOKIE['pwd'])) {
  setcookie('pwd', '', time() - 3600, '/');
}

if (isset($_COOKIE['estilo'])) {
  setcookie('estilo', '', time() - 3600, '/');
}

session_destroy();

header('Location: index.php?logout=success');
exit;
