<?php
$nombreUsuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : $_COOKIE['usu'];

$hoy = (int) date('H');

if ($hoy >= 6 && $hoy < 12) {
  $saludo = "Buenos días";
} elseif ($hoy >= 12 && $hoy < 16) {
  $saludo = "Hola";
} elseif ($hoy >= 16 && $hoy < 20) {
  $saludo = "Buenas tardes";
} else {
  $saludo = "Buenas noches";
}

