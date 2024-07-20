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
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="../estilos/editar1.css">
    <link rel="website icon" type="png" href="https://i.pinimg.com/originals/a0/21/ef/a021ef89da1de7f750cd72bd2b436083.png">
</head>
<body>
    <?php
        include("../navegacion/cliente.php")
    ?>
    <?php
        if(isset($_POST['Guardar_Cambios'])){
            $id_cliente = $_POST['id'];
            $nombre = $_POST["Nombre"];
            $apellidos = $_POST["Apellidos"];
            $numero_celular = $_POST["Numero_celular"];
            $DNI = (int)$_POST["DNI"];
            $razon = $_POST["razon"];

            // Manejo del archivo de imagen
            if (isset($_FILES['Foto']) && $_FILES['Foto']['error'] == 0) {
                $foto = addslashes(file_get_contents($_FILES['Foto']['tmp_name']));
                $sql = "UPDATE clientes SET Nombre = '$nombre', Apellidos = '$apellidos', Numero_celular = '$numero_celular', 
                DNI = '$DNI', Foto = '$foto', razon = '$razon', eliminado = '1' WHERE id_cliente = $id_cliente";
            } else {
                $sql = "UPDATE clientes SET Nombre = '$nombre', Apellidos = '$apellidos', Numero_celular = '$numero_celular', 
                        DNI = '$DNI', razon = '$razon', eliminado = '1' WHERE id_cliente = $id_cliente";
            }

            $resultado = mysqli_query($conexion, $sql);
            if($resultado){
                echo "<script language='JavaScript'>
                        alert('El cliente fue vetado correctamente');
                        location.assign('../index1.php');
                      </script>";
            }else{
                echo "<script language='JavaScript'>
                        alert('El cliente no fue vetado correctamente');
                        location.assign('../index1.php');
                      </script>";
            }
            mysqli_close($conexion);
        } else {
            //Para recuperar todos los datos anteriores
            $id_cliente = $_GET['id'];
            $sql = "SELECT * FROM clientes WHERE id_cliente = $id_cliente";
            $resultado = mysqli_query($conexion, $sql);

            $fila = mysqli_fetch_assoc($resultado);
            $nombre = $fila["Nombre"];
            $apellidos = $fila["Apellidos"];
            $numero_celular = $fila["Numero_celular"];
            $DNI = (int)$fila["DNI"];
            $razon = $fila["razon"];
            $foto = base64_encode($fila["Foto"]);

            mysqli_close($conexion);
    ?>
    <div class="contenedor">
        <h1>Actualizar Datos de los clientes</h1>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data" class="formulario">
            <label class="texto" for="Foto">Foto:</label><br>
            <img src="data:image/jpeg;base64,<?php echo $foto; ?>" alt="Foto de Cliente" class="imagen-cliente"><br><br>
            <input type="file" id="Foto" name="Foto"><br><br>
            <label class="texto" for="Nombre">Nombre:</label><br>
            <input class="relleno" type="text" id="Nombre" name="Nombre" value="<?php echo $nombre; ?>" required><br><br>
            
            <label class="texto" for="Apellidos">Apellidos:</label><br>
            <input class="relleno" type="text" id="Apellidos" name="Apellidos" value="<?php echo $apellidos; ?>" required><br><br>
            
            <label class="texto" for="DNI">DNI:</label><br>
            <input class="relleno" type="text" id="DNI" name="DNI" value="<?php echo $DNI; ?>" required><br><br>

            <label class="texto" for="Numero_celular">Número de Celular:</label><br>
            <input class="relleno" type="text" id="Numero_celular" name="Numero_celular" value="<?php echo $numero_celular; ?>" required><br><br>
            
            <label class="texto" for="razon">Razon de vetar:</label><br>
            <input class="relleno" type="text" id="razon" name="razon" value="<?php echo $razon; ?>" required><br><br>

            <input type="hidden" name="id" value="<?php echo $id_cliente; ?>">
            <input class="envio" type="submit" name="Guardar_Cambios" value="Guardar Cambios">
        </form>
    <?php
        }
    ?>
    </div>
</body>
</html>
