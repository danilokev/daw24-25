<?php
session_start();

// Conexión a la base de datos
include "inc/conexion-db.php";

// Compruebo si el usuario ha marcado "recuérdame"
if (!isset($_SESSION['usuario']) && isset($_COOKIE['usu']) && isset($_COOKIE['pwd'])) {
  $_SESSION['usuario'] = $_COOKIE['usu'];

  // Actualizar la cookie de última visita
  setcookie('ultima_visita', date('d/m/Y H:i'), time() + (90 * 24 * 60 * 60), '/');
}

// Inicializo el estilo predeterminado
$estilo = 'styles.css'; // Archivo CSS predeterminado

// Compruebo si hay un estilo seleccionado en sesión
if (isset($_SESSION['estilo'])) {
    $estilo = $_SESSION['estilo'];
} elseif (isset($_COOKIE['estilo'])) {
    $estilo = $_COOKIE['estilo'];
} elseif (isset($_SESSION['usuario'])) {
    // Si el usuario está autenticado, recupero el estilo desde la base de datos
    $idUsuario = $_SESSION['usuario'];
    $sqlEstiloUsuario = "SELECT `estilo` FROM `usuarios` WHERE `idUsuario` = ?";
    $stmt = $conn->prepare($sqlEstiloUsuario);

    if ($stmt) {
        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();
        $stmt->bind_result($idEstilo);
        if ($stmt->fetch()) {
            $estilo = "estilo{$idEstilo}.css"; // Genero el nombre del archivo CSS basado en el ID
        }
        $stmt->close();
    }
}

// Si el estilo aún no se ha determinado, usar el predeterminado
//$estilo = $estilo ?? 'styles.css';
echo "<pre style='background-color:#FFF; color:#000'>"; 
print_r($_SESSION);
print_r($estilo);

echo "</pre>";


?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $titulo; ?></title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/<?= $estilo ?>?v=<?= time(); ?>" title="Estilo seleccionado">
  <link rel="stylesheet" href="css/print.css" media="print">
  <link rel="stylesheet" href="css/fontello.css">
</head>
<body>
