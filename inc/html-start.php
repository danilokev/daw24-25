<?php
session_start();

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

  <!-- <link rel="stylesheet" href="css/styles.css">
  <link rel="alternate stylesheet" href="css/" title="Modo noche">
  <link rel="alternate stylesheet" href="css/contrast.css" title="Modo alto contraste">
  <link rel="alternate stylesheet" href="css/big.css" title="Modo con Letra Mayor">
  <link rel="alternate stylesheet" href="css/contrast-big.css" title="Modo alto contraste y con Letra Mayor">
  <link rel="stylesheet" href="css/print.css" media="print">
  <link rel="stylesheet" href="css/fontello.css"> -->
</head>
<body>