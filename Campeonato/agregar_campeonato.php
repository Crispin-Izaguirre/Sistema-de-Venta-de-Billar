<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:../index.php');
    exit;
}
include("../conexion.php");

$id_admin_actual = $_SESSION['admin_id']; 

if(isset($_POST['Agregar_Campeonato'])){
    $nombre = $_POST["nombre"];
    $fecha_inicio = $_POST["fecha"];
    $descripcion = $_POST["descripcion"];

    // Validación de datos (puedes adaptar según tus requisitos)
    if (empty($nombre) || empty($fecha_inicio) || empty($descripcion)) {
        echo "<script>alert('Por favor, completa todos los campos');</script>";
        exit;
    }

    // Preparar consulta SQL para insertar el nuevo campeonato
    $sql = "INSERT INTO campeonato (nombre, fecha, descripcion, administradores_id_admin) 
            VALUES ('$nombre', '$fecha_inicio', '$descripcion', '$id_admin_actual')";

    $resultado = mysqli_query($conexion, $sql);
    if($resultado){
        echo "<script language='JavaScript'>
                alert('El campeonato se agregó correctamente');
                location.assign('../index1.php');
              </script>";
    } else {
        echo "<script language='JavaScript'>
                alert('Error al agregar el campeonato');
                location.assign('agregar_campeonato.php');
              </script>";
    }
    mysqli_close($conexion);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Campeonato</title>
    <link rel="stylesheet" href="../estilos/editar1.css">
    <link rel="icon" type="image/png" href="https://i.pinimg.com/originals/a0/21/ef/a021ef89da1de7f750cd72bd2b436083.png">
    <script>
        function validateForm() {
            var nombre = document.getElementById("nombre").value;
            var fecha_inicio = document.getElementById("fecha_inicio").value;
            var descripcion = document.getElementById("descripcion").value;

            if (nombre.trim() === '' || fecha.trim() === '' || descripcion.trim() === '') {
                alert("Por favor, completa todos los campos.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <?php include("../navegacion/campeonato.php") ?>
    <div class="contenedor">
        <h1>Agregar un nuevo campeonato</h1>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" class="formulario" onsubmit="return validateForm()">
            <label class="texto" for="nombre">Nombre del Campeonato:</label><br>
            <input class="relleno" type="text" id="nombre" name="nombre" required><br><br>
            <label class="texto" for="fecha">Fecha de Inicio:</label><br>
            <input class="relleno" type="date" id="fecha_inicio" name="fecha" required><br><br>
            <label class="texto" for="descripcion">Descripción:</label><br>
            <textarea id="descripcion" name="descripcion" rows="4" cols="50" required></textarea><br><br>
            <input class="envio" type="submit" name="Agregar_Campeonato" value="Agregar Campeonato">
        </form>
    </div>
</body>
</html>
