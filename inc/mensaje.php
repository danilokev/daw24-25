<?php
if (isset($_COOKIE['usu'])) {
  $nombreUsuario = $_COOKIE['usu'];

  $ultimaVisita = isset($_COOKIE['ultima_visita']) ? $_COOKIE['ultima_visita'] : null;

  if ($ultimaVisita) {
    $mensaje = "Tu última visita fue el $ultimaVisita";
  }
} else {
  $mensaje = null;
}
