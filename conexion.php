<?php

$dbname = "billar4";
$dbuser = "root";
$dbhost = "localhost";
$dbpass = "";

$conexion = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>
