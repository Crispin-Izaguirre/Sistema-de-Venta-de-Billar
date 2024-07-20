<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:../index.php');
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('location:campeonato.php');
    exit;
}

$id_campeonato = $_GET['id'];
include("../conexion.php");

// Obtener los detalles del campeonato
$sql = "SELECT * FROM campeonato WHERE id_campeonato = $id_campeonato";
$resultado = mysqli_query($conexion, $sql);

if (mysqli_num_rows($resultado) == 1) {
    $campeonato = mysqli_fetch_assoc($resultado);
} else {
    echo "<script>alert('No se encontró el campeonato.'); window.location.href='campeonato.php';</script>";
    exit;
}

$errores = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim(mysqli_real_escape_string($conexion, $_POST['nombre']));
    $fecha = trim(mysqli_real_escape_string($conexion, $_POST['fecha']));
    $descripcion = trim(mysqli_real_escape_string($conexion, $_POST['descripcion']));

    // Validación de datos
    if (empty($nombre)) {
        $errores[] = "El nombre es obligatorio.";
    }
    if (empty($fecha)) {
        $errores[] = "La fecha es obligatoria.";
    } elseif (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $fecha)) {
        $errores[] = "El formato de la fecha no es válido.";
    }
    if (empty($descripcion)) {
        $errores[] = "La descripción es obligatoria.";
    }

    if (empty($errores)) {
        $sql = "UPDATE campeonato SET nombre = '$nombre', fecha = '$fecha', descripcion = '$descripcion' WHERE id_campeonato = $id_campeonato";
        if (mysqli_query($conexion, $sql)) {
            echo "<script>alert('Campeonato actualizado exitosamente.'); window.location.href='campeonato.php';</script>";
        } else {
            $errores[] = "Error al actualizar el campeonato.";
        }
    }
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Campeonato</title>
    <link rel="stylesheet" href="../estilos/editar1.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="website icon" type="png" href="https://i.pinimg.com/originals/a0/21/ef/a021ef89da1de7f750cd72bd2b436083.png">
</head>
<body>
    <?php include("../navegacion/campeonato.php"); ?>
    <h1>Editar Campeonato</h1>

    <?php
    if (!empty($errores)) {
        echo "<div class='errores'>";
        foreach ($errores as $error) {
            echo "<p>$error</p>";
        }
        echo "</div>";
    }
    ?>

    <form action="editar.php?id=<?php echo $id_campeonato; ?>" method="POST" class="formulario">
        <label class="texto" for="nombre">Nombre del Campeonato:</label><br>
        <input class="relleno" type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($campeonato['nombre']); ?>" required><br><br>
        <label class="texto" for="fecha">Fecha de Inicio:</label><br>
        <input class="relleno" type="date" id="fecha_inicio" name="fecha" value="<?php echo htmlspecialchars($campeonato['fecha']); ?>" required><br><br>
        <label class="texto" for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion" rows="4" cols="50" required><?php echo htmlspecialchars($campeonato['descripcion']); ?></textarea><br><br>
        <input class="envio" type="submit" value="Actualizar Campeonato" class="boton">
    </form>
</body>
</html>
