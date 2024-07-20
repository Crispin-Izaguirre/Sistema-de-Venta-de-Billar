<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:../index.php');
    exit;
}
?>
<?php
    include("../conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Participante</title>
    <link rel="stylesheet" href="../estilos/editar1.css">
    <link rel="website icon" type="png" href="https://i.pinimg.com/originals/a0/21/ef/a021ef89da1de7f750cd72bd2b436083.png">
    <script>
        function validateForm() {
            var nombre = document.getElementById("Nombre").value.trim();
            var apellidos = document.getElementById("Apellidos").value.trim();
            var dni = document.getElementById("DNI").value.trim();
            var celular = document.getElementById("Numero_celular").value.trim();
            var dniRegex = /^[0-9]{8}$/;

            if (nombre === "" || apellidos === "" || dni === "" || celular === "") {
                alert("Por favor, completa todos los campos.");
                return false;
            }

            if (!dniRegex.test(dni)) {
                alert("Por favor, ingresa un DNI válido de 8 dígitos.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <?php
        include("../navegacion/campeonato.php");
    ?>
    <?php
        if (isset($_POST['Agregar'])) {
            $id_cliente = $_POST['id'];
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $numero_celular = $_POST['numero_celular'];
            $DNI = $_POST['dni'];
            $foto = $_POST['Foto'];
            if (isset($_FILES['Foto']) && $_FILES['Foto']['error'] == 0) {
                $foto = addslashes(file_get_contents($_FILES['Foto']['tmp_name']));
                $sql = "UPDATE participante SET Foto = '$foto', Nombre = '$nombre', Apellidos = '$apellidos', Numero_celular = '$numero_celular', DNI = '$DNI' WHERE id_participante = $id_cliente";
            } else {
                $sql = "UPDATE participante SET Nombre = '$nombre', Apellidos = '$apellidos', Numero_celular = '$numero_celular', DNI = '$DNI' WHERE id_participante = $id_cliente";
            }
            $resultado = mysqli_query($conexion, $sql);
            if($resultado){
                echo "<script language='JavaScript'>
                        alert('Los datos fueron actualizados de manera correcta');
                        location.assign('campeonato.php');
                      </script>";
            }else{
                echo "<script language='JavaScript'>
                        alert('Los datos NO fueron actualizados de manera correcta');
                        location.assign('campeonato.php');
                      </script>";
            }
            mysqli_close($conexion);
        } else {
            // Para recuperar todos los datos anteriores
            $id_cliente = $_GET['id'];
            $sql = "SELECT * FROM participante WHERE id_participante = $id_cliente";
            $resultado = mysqli_query($conexion, $sql);
            $fila = mysqli_fetch_assoc($resultado);
            $nombre = $fila["Nombre"];
            $apellidos = $fila["Apellidos"];
            $numero_celular = $fila["Numero_celular"];
            $DNI = (int)$fila["DNI"];
            $foto = base64_encode($fila["Foto"]);
            mysqli_close($conexion);
    ?>
    <div class="contenedor">
        <h1>Editar Participante</h1>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data" class="formulario" onsubmit="return validateForm()">
            <label class="texto" for="Foto">Foto:</label><br>
            <img src="data:image/jpeg;base64,<?php echo $foto; ?>" alt="Foto de Cliente" class="imagen-cliente"><br><br>
            <input type="file" id="Foto" name="Foto"><br><br>
            <label class="texto" for="Nombre">Nombre:</label><br>
            <input class="relleno" type="text" id="Nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required><br><br>
            <label class="texto" for="Apellidos">Apellidos:</label><br>
            <input class="relleno" type="text" id="Apellidos" name="apellidos" value="<?php echo htmlspecialchars($apellidos); ?>" required><br><br>
            <label class="texto" for="DNI">DNI:</label><br>
            <input class="relleno" type="text" id="DNI" name="dni" value="<?php echo htmlspecialchars($DNI); ?>" required><br><br>
            <label class="texto" for="Numero_celular">Número de Celular:</label><br>
            <input class="relleno" type="text" id="Numero_celular" name="numero_celular" value="<?php echo htmlspecialchars($numero_celular); ?>" required><br><br>
            <input type="hidden" name="id" value="<?php echo $id_cliente; ?>">
            <input class="envio" type="submit" name="Agregar" value="Agregar Participante">
        </form>
    <?php
        }
    ?>
    </div>
</body>
</html>
