<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:../index.php');
    exit;
}
include("../conexion.php");

// Es obligatorio el extraer o llamar el ID del administrador
$id_admin_actual = $_SESSION['admin_id']; 

if(isset($_POST['Agregar_Cliente'])){
    $nombre = $_POST["Nombre"];
    $apellidos = $_POST["Apellidos"];
    $numero_celular = $_POST["Numero_celular"];
    $DNI = $_POST["DNI"];

    // Esto es para validar la informacion en el servidor
    if (!preg_match("/^[a-zA-ZÀ-ÿ\s\-]+$/", $nombre)) {
        echo "<script>alert('El nombre solo debe contener letras');</script>";
        exit;
    }
    if (!preg_match("/^[a-zA-ZÀ-ÿ\s\-]+$/", $apellidos)) {
        echo "<script>alert('Los apellidos solo deben contener letras, espacios y guiones');</script>";
        exit;
    }
    if (strlen($DNI) != 8 || !is_numeric($DNI)) {
        echo "<script>alert('El DNI debe tener 8 cifras y solo contener números');</script>";
        exit;
    }
    if (strlen($numero_celular) != 9 || !is_numeric($numero_celular)) {
        echo "<script>alert('El número de celular debe tener 9 cifras y solo contener números');</script>";
        exit;
    }
    // Lo usamos para el manejo de la imagen y lo convierta en codigo
    if (isset($_FILES['Foto']) && $_FILES['Foto']['error'] == 0) {
        $foto = addslashes(file_get_contents($_FILES['Foto']['tmp_name']));
        $sql = "INSERT INTO clientes (Nombre, Apellidos, Numero_celular, DNI, Foto, socio, eliminado, administradores_id_admin) 
                VALUES ('$nombre', '$apellidos', '$numero_celular', '$DNI', '$foto', '0', '0', '$id_admin_actual')";
        
        $resultado = mysqli_query($conexion, $sql);
        if($resultado){
            echo "<script language='JavaScript'>
                    alert('El cliente se afilió correctamente');
                    location.assign('../index1.php');
                  </script>";
        } else {
            echo "<script language='JavaScript'>
                    alert('Error al afiliar el cliente');
                    location.assign('agregar.php');
                  </script>";
        }
    } else {
        echo "<script language='JavaScript'>
                alert('Error: No se ha seleccionado ninguna imagen');
                location.assign('agregar.php');
              </script>";
    }

    mysqli_close($conexion);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo cliente</title>
    <link rel="stylesheet" href="../estilos/editar1.css">
    <link rel="icon" type="image/png" href="https://i.pinimg.com/originals/a0/21/ef/a021ef89da1de7f750cd72bd2b436083.png">
    <script>
        // Una pequeña validacion para los inputs
        function validateForm() {
            var nombre = document.getElementById("Nombre").value;
            var apellidos = document.getElementById("Apellidos").value;
            var dni = document.getElementById("DNI").value;
            var numero_celular = document.getElementById("Numero_celular").value;
            if (!/^[a-zA-ZÀ-ÿ\s\-]+$/.test(nombre)) {
                alert("El nombre solo debe contener letras.");
                return false;
            }
            if (!/^[a-zA-ZÀ-ÿ\s\-]+$/.test(apellidos)) {
                alert("Los apellidos solo deben contener letras, espacios y guiones.");
                return false;
            }
            if (dni.length !== 8 || !/^\d+$/.test(dni)) {
                alert("El DNI debe tener 8 cifras y solo contener números.");
                return false;
            }
            if (numero_celular.length !== 9 || !/^\d+$/.test(numero_celular)) {
                alert("El número de celular debe tener 9 cifras y solo contener números.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <?php
        include("../navegacion/cliente.php")
    ?>
    <div class="contenedor">
        <h1>Agregar un nuevo cliente</h1>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data" class="formulario" onsubmit="return validateForm()">
            
            <label class="texto" for="Foto">Foto:</label><br>
            <img src="../Imagenes/Sinfoto.webp" alt="Imagen de ejemplo" class="imagen-cliente">
            <input type="file" id="Foto" name="Foto" required><br><br>
            <label class="texto" for="Nombre">Nombre:</label><br>
            <input class="relleno" type="text" id="Nombre" name="Nombre" required><br><br>
            <label class="texto" for="Apellidos">Apellidos:</label><br>
            <input class="relleno" type="text" id="Apellidos" name="Apellidos" required><br><br>
            <label class="texto" for="DNI">DNI:</label><br>
            <input class="relleno" type="text" id="DNI" name="DNI" required maxlength="8"><br><br>
            <label class="texto" for="Numero_celular">Número de Celular:</label><br>
            <input class="relleno" type="text" id="Numero_celular" name="Numero_celular" required maxlength="9"><br><br>
            <input class="envio" type="submit" name="Agregar_Cliente" value="Agregar Cliente">
        </form>
    </div>
</body>
</html>
