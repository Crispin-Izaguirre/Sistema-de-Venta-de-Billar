<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:../index.php');
    exit;
}
?>
<?php
include("../conexion.php");

if(isset($_POST['Agregar_Cliente'])){
    $nombre = $_POST["Nombre"];
    $apellidos = $_POST["Apellidos"];
    $numero_celular = $_POST["Numero_celular"];
    $DNI = (int)$_POST["DNI"];

    // Manejo del archivo de imagen
    if (isset($_FILES['Foto']) && $_FILES['Foto']['error'] == 0) {
        $foto = addslashes(file_get_contents($_FILES['Foto']['tmp_name']));
        $sql = "INSERT INTO campeonato (Nombre, Apellido, Numero_celular, DNI, Foto, cuarto_final, eliminado, semi_final, final, Ganador) 
                VALUES ('$nombre', '$apellidos', '$numero_celular', '$DNI', '$foto', '0', '0', '0', '0', '0')";
        
        $resultado = mysqli_query($conexion, $sql);
        if($resultado){
            echo "<script language='JavaScript'>
                    alert('El cliente se afilió correctamente');
                    location.assign('../index1.php');
                  </script>";
        } else {
            echo "<script language='JavaScript'>
                    alert('Error al afiliar el cliente');
                    location.assign('../agregar1.php');
                  </script>";
        }
    } else {
        echo "<script language='JavaScript'>
                alert('Error: No se ha seleccionado ninguna imagen');
                location.assign('../cliente/agregar.php');
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
    <title>Agregar a un Nuevo Participante</title>
    <link rel="stylesheet" href="../estilos/campeonato1.css">
    <link rel="icon" type="image/png" href="https://i.pinimg.com/originals/a0/21/ef/a021ef89da1de7f750cd72bd2b436083.png">
</head>
<body>
        <?php
            include("../navegacion/campeonato.php");
        ?>
    <div class="contenedor">
        <h1>AGREGAR NUEVO PARTICIPANTE</h1>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data" class="formulario">
            
            <label class="texto" for="Foto">Foto:</label><br>
            <img src="https://www.shutterstock.com/image-vector/billiard-tournament-banner-winner-cup-260nw-2476319523.jpg" alt="Imagen de ejemplo" class="imagen-cliente">
            <input type="file" id="Foto" name="Foto" required><br><br>
            <label class="texto" for="Nombre">Nombre:</label><br>
            <input class="relleno" type="text" id="Nombre" name="Nombre" required><br><br>
            <label class="texto" for="Apellidos">Apellidos:</label><br>
            <input class="relleno" type="text" id="Apellidos" name="Apellidos" required><br><br>
            <label class="texto" for="DNI">DNI:</label><br>
            <input class="relleno" type="text" id="DNI" name="DNI" required><br><br>
            <label class="texto" for="Numero_celular">Número de Celular:</label><br>
            <input class="relleno" type="text" id="Numero_celular" name="Numero_celular" required><br><br>
            <input class="envio" type="submit" name="Agregar_Cliente" value="Agregar Participante">
        </form>
    </div>
</body>
</html>
