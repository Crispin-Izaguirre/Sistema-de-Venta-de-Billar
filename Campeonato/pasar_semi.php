<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:../index.php');
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id']) || !isset($_GET['campeonato_id']) || empty($_GET['campeonato_id'])) {
    header('location:lista_campeonatos.php');
    exit;
}

$id_participante = $_GET['id'];
$id_campeonato = $_GET['campeonato_id'];
include("../conexion.php");

$sql = "INSERT INTO semi_final (participante_id_participante, campeonato_id_campeonato) VALUES ($id_participante, $id_campeonato)";
$resultado = mysqli_query($conexion, $sql);

if ($resultado) {
    echo "<script>alert('El participante ha sido pasado a Semifinal.'); window.location.href='visualizar_participante.php?id=$id_campeonato';</script>";
} else {
    echo "<script>alert('No se pudo actualizar el estado del participante.'); window.location.href='visualizar_participante.php?id=$id_campeonato';</script>";
}

mysqli_close($conexion);
?>
