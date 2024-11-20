<?php
$host       = "localhost";
$dbUserName = "wwwdata";
$dbPassword = "daw";
$dbName     = "pibd";

$conn = @new mysqli($host, $dbUserName, $dbPassword, $dbName);

if ($conn->connect_error) {
  echo '<p>Error al conectar con la base de datos: ' . $conn->connect_error . '</p>';
  exit;
}
