<?php
// Iniciar la sesión solo si no está ya activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "inc/conexion-db.php"; // Conexión a la base de datos

$esValido = false;

// Obtener los datos del formulario
$usu = $_POST['usu'] ?? '';
$pwd = $_POST['pwd'] ?? '';

// Validar los datos ingresados
if (empty($usu) || empty($pwd)) {
    $mensajeError = urlencode('Debes completar todos los campos');
    header("Location: index.php?error=$mensajeError");
    exit;
}

// Consultar en la tabla Usuarios
$sql = "SELECT IdUsuario, NomUsuario, Clave, Estilo FROM Usuarios WHERE NomUsuario = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error al preparar la consulta: " . $conn->error);
}

$stmt->bind_param("s", $usu);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si el usuario existe
if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();
    
    // Comparar la contraseña
    if (password_verify($pwd, $usuario['Clave'])) { // Para contraseñas encriptadas
        $esValido = true;
        $idUsuario = $usuario['IdUsuario'];
        $estiloUsuario = $usuario['Estilo'];
    } else {
        // Si las contraseñas están en texto plano, usa esta línea temporalmente:
         $esValido = $pwd === $usuario['Clave'];
    }
}

if ($esValido) {
    // Iniciar sesión y guardar información
    $_SESSION['usuario'] = $usu;
    $_SESSION['idUsuario'] = $idUsuario;
    $_SESSION['estilo'] = $estiloUsuario;

    // Manejo de cookies si se seleccionó "Recuérdame"
    if (isset($_POST['recuerdame'])) {
        setcookie('usu', $usu, time() + (90 * 24 * 60 * 60), '/');
        setcookie('idUsuario', $idUsuario, time() + (90 * 24 * 60 * 60), '/');
        setcookie('estilo', $estiloUsuario, time() + (90 * 24 * 60 * 60), '/');
        setcookie('ultima_visita', date('d/m/Y H:i'), time() + (90 * 24 * 60 * 60), '/');
    }

    // Redirección a la página de usuario
    header('Location: menu-usuario.php');
    exit;
} else {
    // Redirección a la página de inicio con mensaje de error
    $mensajeError = urlencode('Usuario o contraseña incorrectos');
    header("Location: index.php?error=$mensajeError");
    exit;
}
