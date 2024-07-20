<?php
session_start();

// Incluir el archivo de configuración de Google
include('config.php');

// Verificar si la sesión de Google está activa y revocar el token si es así
if (isset($_SESSION['access_token'])) {
    $google_client->revokeToken();
}

// Destruir todos los datos de la sesión
session_destroy();

// Redirigir a la página de inicio de sesión
header('location:index.php');
exit;
?>