<?php

// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluir la biblioteca de cliente de Google
require_once 'vendor/autoload.php';

// Crear objeto del cliente de la API de Google
$google_client = new Google_Client();

// Establecer el ID de cliente de OAuth 2.0
$google_client->setClientId('279493389382-ap62mibqka6r9nrh87ecbu9lboik2q1o.apps.googleusercontent.com');

// Establecer la clave secreta del cliente de OAuth 2.0
$google_client->setClientSecret('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');

// Establecer la URL de redirección de OAuth 2.0
$google_client->setRedirectUri('http://localhost/crudpro6/iniciar.php');

// Obtener el correo electrónico y el perfil
$google_client->addScope('email');
$google_client->addScope('profile');

?>
