<?php
session_start();

$esValido = false;

// creo un array con los usuarios y contraseñas
$usuarios = [
  ['usu' => 'usuario1', 'pwd' => 'usuario1'],
  ['usu' => 'usuario2', 'pwd' => 'usuario2'],
  ['usu' => 'usuario3', 'pwd' => 'usuario3'],
  ['usu' => 'usuario4', 'pwd' => 'usuario4']
];

// obtengo los datos del formulario
$usu = $_POST['usu'];
$pwd = $_POST['pwd'];

// recorro el array y compruebo si los datos son validos
foreach ($usuarios as $usuario) {
  if ($usu == $usuario['usu'] && $pwd == $usuario['pwd']) {
    $esValido = true;
    break;
  }
}

if ($esValido) {
  //$_SESSION['usuario'] = $usu;

  if (isset($_POST['recuerdame'])) {
    setcookie('usu', $usu, time() + (90 * 24 * 60 * 60), '/');
    setcookie('pwd', $pwd, time() + (90 * 24 * 60 * 60), '/');
  } else {
    setcookie('usu', '', time() - 3600, '/');
    setcookie('pwd', '', time() - 3600, '/');
  }

  header('Location: menu-usuario.php');
} else {
  $_SESSION['error'] = 'Usuario o contraseña incorrectos';
  header('Location: index.php');
}
