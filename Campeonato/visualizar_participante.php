<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:../index.php');
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('location:visualizar_participante.php');
    exit;
}

$id_campeonato = $_GET['id'];
include("../conexion.php");

// Obtener el nombre del campeonato
$sql_campeonato = "SELECT nombre FROM campeonato WHERE id_campeonato = $id_campeonato";
$resultado_campeonato = mysqli_query($conexion, $sql_campeonato);

if (mysqli_num_rows($resultado_campeonato) != 1) {
    echo "<script>alert('No se encontró el campeonato.'); window.location.href='visualizar_participante.php';</script>";
    exit;
}

$campeonato = mysqli_fetch_assoc($resultado_campeonato);

// Consulta para obtener los participantes del campeonato específico
$sql = "SELECT * FROM participante WHERE eliminado = 0 AND campeonato_id = $id_campeonato";
$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participantes del Campeonato</title>
    <link rel="stylesheet" href="../prueba.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="website icon" type="png" href="https://i.pinimg.com/originals/a0/21/ef/a021ef89da1de7f750cd72bd2b436083.png">
</head>
<body>
    <?php include("../navegacion/campeonato.php"); ?>
    <h1>Participantes del Campeonato: <?php echo htmlspecialchars($campeonato['nombre']); ?></h1>
    <table class="tabla_principal">
        <thead>
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Número de Celular</th>
                <th>DNI</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php 
                while($filas=mysqli_fetch_assoc($resultado)){
                    $foto = base64_encode($filas['Foto']);
            ?>
            <tr>
                <td> <?php echo $filas['id_participante']; ?> </td>
                <td><img src="data:image/jpeg;base64,<?php echo $foto; ?>" alt="Foto de Cliente" width="70" height="70" class="transfor"></td>
                <td> <?php echo $filas['Nombre']; ?> </td>
                <td> <?php echo $filas['Apellidos']; ?> </td>
                <td> <?php echo $filas['Numero_celular']; ?> </td>
                <td> <?php echo $filas['DNI']; ?> </td>
                <td class="accion">
                    <?php echo "<a href='editar_participante.php?id=".$filas['id_participante']."'>Editar</a>"; ?>
                    <?php echo "<a href='eliminar_participante.php?id=".$filas['id_participante']."'>Eliminar</a>"; ?>
                    <?php echo "<a href='pasar_cuartos.php?id=".$filas['id_participante']."&campeonato_id=".$id_campeonato."'>Cuartos</a>"; ?>
                    <?php echo "<a href='pasar_semi.php?id=".$filas['id_participante']."&campeonato_id=".$id_campeonato."'>SemiFinal</a>"; ?>
                    <?php echo "<a href='pasar_final.php?id=".$filas['id_participante']."&campeonato_id=".$id_campeonato."'>Final</a>"; ?>
                    <?php echo "<a href='hacer_ganador.php?id=".$filas['id_participante']."&campeonato_id=".$id_campeonato."'>Ganador</a>"; ?>
                </td>
            </tr>
            <?php 
                }
            ?>
        </tbody>
    </table>
    <?php
    mysqli_close($conexion);
    ?>
</body>
</html>
