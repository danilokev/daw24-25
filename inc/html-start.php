<?php
session_start();

// compruebo si el usuario ha marcado "recuerdame"
if (!isset($_SESSION['usuario']) && isset($_COOKIE['usu']) && isset($_COOKIE['pwd'])) {
  $_SESSION['usuario'] = $_COOKIE['usu'];

  // Actualizar la cookie de última visita
  setcookie('ultima_visita', date('d/m/Y H:i'), time() + (90 * 24 * 60 * 60), '/');
}

// compruebo si hay un estilo seleccionado
if (isset($_SESSION['estilo'])) {
  $estilo = $_SESSION['estilo'];
} elseif (isset($_COOKIE['estilo'])) {
  $estilo = $_COOKIE['estilo'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $titulo; ?></title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/<?= $estilo ?>" title="Modo noche">
  <link rel="stylesheet" href="css/print.css" media="print">
  <link rel="stylesheet" href="css/fontello.css">
</head>
<body>