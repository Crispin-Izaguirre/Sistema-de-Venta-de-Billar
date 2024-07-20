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
    <title>Agregar Participante</title>
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
            $campeonato_id = $_POST['campeonato'];
            $administradores_id_admin = $_SESSION['admin_id'];
            
            if (isset($_FILES['Foto']) && $_FILES['Foto']['error'] == 0) {
                $foto = addslashes(file_get_contents($_FILES['Foto']['tmp_name']));
                $sql = "INSERT INTO participante (Nombre, Apellidos, Numero_celular, DNI, campeonato_id, Foto, administradores_id_admin, clientes_id_cliente) VALUES ('$nombre', '$apellidos', '$numero_celular', '$DNI', '$campeonato_id', '$foto', '$administradores_id_admin', '$id_cliente')";
            } else {
                $sql = "INSERT INTO participante (Nombre, Apellidos, Numero_celular, DNI, campeonato_id, administradores_id_admin, clientes_id_cliente) VALUES ('$nombre', '$apellidos', '$numero_celular', '$DNI', '$campeonato_id', '$administradores_id_admin', '$id_cliente')";
            }
            $resultado = mysqli_query($conexion, $sql);
            if($resultado){
                echo "<script language='JavaScript'>
                        alert('Los datos fueron actualizados de manera correcta');
                        location.assign('../index1.php');
                      </script>";
            }else{
                echo "<script language='JavaScript'>
                        alert('Los datos NO fueron actualizados de manera correcta');
                        location.assign('../index1.php');
                      </script>";
            }
            mysqli_close($conexion);
        } else {
            // Para recuperar todos los datos anteriores
            $id_cliente = $_GET['id'];
            $sql = "SELECT * FROM clientes WHERE id_cliente = $id_cliente";
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
        <h1>Agregar Participante</h1>
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
            <label class="texto" for="campeonato">Campeonato:</label><br>
            <select class="relleno" id="campeonato" name="campeonato" required>
                <option value="">Seleccionar Campeonato</option>
                <?php
                include("../conexion.php");
                $result = mysqli_query($conexion, "SELECT id_campeonato, nombre FROM campeonato");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='".$row['id_campeonato']."'>".$row['nombre']."</option>";
                }
                mysqli_close($conexion);
                ?>
            </select><br><br>
            <input class="envio" type="submit" name="Agregar" value="Agregar Participante">
        </form>
    <?php
        }
    ?>
    </div>
</body>
</html>
