<?php
session_start();
// creo cuatro usuarios con nombre de usuario y contraseña
$usuario1 = [
  'usu' => 'usuario1',
  'pwd' => 'usuario1'
];

$usuario2 = [
  'usu' => 'usuario2',
  'pwd' => 'usuario2'
];

$usuario3 = [
  'usu' => 'usuario3',
  'pwd' => 'usuario3'
];

$usuario4 = [
  'usu' => 'usuario4',
  'pwd' => 'usuario4'
];

// obtengo los datos del formulario
$usu = $_POST['usu'];
$pwd = $_POST['pwd'];

// compruebo si el usuario y la contraseña son correctos y redirijo a la página correspondiente
if ($usu == $usuario1['usu'] && $pwd == $usuario1['pwd']) {
  header('Location: menu-usuario.php');
} elseif ($usu == $usuario2['usu'] && $pwd == $usuario2['pwd']) {
  header('Location: menu-usuario.php');
} elseif ($usu == $usuario3['usu'] && $pwd == $usuario3['pwd']) {
  header('Location: menu-usuario.php');
} elseif ($usu == $usuario4['usu'] && $pwd == $usuario4['pwd']) {
  header('Location: menu-usuario.php');
} else {
  // creo un mensaje de error y redirijo a la página de inicio
  $_SESSION['error'] = 'Usuario o contraseña incorrectos';
  header('Location: index.php');
}
