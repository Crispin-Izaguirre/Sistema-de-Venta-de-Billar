<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:../index.php');
    exit;
}
?>
<?php
include("../conexion.php");

if (isset($_POST['Guardar_Cambios'])) {
    $id_cliente = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $numero_celular = $_POST['numero_celular'];
    $DNI = $_POST['dni'];
    $fecha = $_POST['fecha'];
    $tiempo = $_POST['tiempo'];
    $socio = $_POST['socio'];
    $mesa = $_POST['mesas_id_mesa'];

    if ($socio == "Es un socio, paga 6 soles la hora") {
        $monto = (intval($tiempo) / 30) * 3;
    } else {
        $monto = (intval($tiempo) / 30) * 4;
    }

    // Actualizar los datos del cliente
    $sql = "UPDATE ventas SET 
                Nombre='$nombre', 
                Apellidos='$apellidos', 
                Numero_celular='$numero_celular', 
                DNI='$DNI', 
                monto='$monto', 
                fecha='$fecha', 
                socio='$socio', 
                mesas_id_mesa='$mesa', 
                tiempo='$tiempo'
            WHERE id_venta='$id_cliente'";

    $resultado = mysqli_query($conexion, $sql);
    
    if ($resultado) {
        echo "<script language='JavaScript'>
                alert('Se realizó la compra y actualización correctamente');
                location.assign('../cliente/historial.php');
              </script>";
    } else {
        echo "<script language='JavaScript'>
                alert('No se pudo realizar la compra');
                location.assign('../cliente/historial.php');
              </script>";
    }
    
    mysqli_close($conexion);
} else {
    // Recuperar datos del cliente para mostrar en el formulario
    $id_cliente = $_GET['id'];
    $sql = "SELECT * FROM ventas WHERE id_venta = $id_cliente";
    $resultado = mysqli_query($conexion, $sql);
    $fila = mysqli_fetch_assoc($resultado);
    $nombre = $fila['Nombre'];
    $apellidos = $fila['Apellidos'];
    $numero_celular = $fila['Numero_celular'];
    $DNI = $fila['DNI'];
    $socio = $fila['socio'];
    $monto = $fila['monto'];
    $fecha = $fila['fecha'];
    $mesa = $fila['mesas_id_mesa'];
    $tiempo = $fila['tiempo'];

    mysqli_close($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Compra</title>
    <link rel="stylesheet" href="../estilos/registro1.css">
    <link rel="icon" type="image/png" href="https://i.pinimg.com/originals/a0/21/ef/a021ef89da1de7f750cd72bd2b436083.png">
</head>
<body>
    <?php
        include("../navegacion/venta.php")
    ?>

    <div class="form-container">
        <h2>Boleta de Venta</h2>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data" class="formulario">
            <div class="logo-container">
                <img src="https://www.sportbillarperu.com/wp-content/uploads/2022/06/oficial-wp.png" alt="Logo">
            </div>
            <div class="form-content">
                <input type="hidden" name="id" value="<?php echo $id_cliente; ?>">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nom" value="<?php echo $nombre; ?>" required disabled>
                    <input type="hidden" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
                </div>
                <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" id="apellidos" name="ape" value="<?php echo $apellidos; ?>" required disabled>
                    <input type="hidden" id="apellidos" name="apellidos" value="<?php echo $apellidos; ?>" required>
                </div>
                <div class="form-group">
                    <label for="dni">DNI</label>
                    <input type="text" id="dni" name="d" value="<?php echo $DNI; ?>" required disabled>
                    <input type="hidden" id="dni" name="dni" value="<?php echo $DNI; ?>" required>
                </div>
                <div class="form-group">
                    <label for="numero_celular">Número de Celular</label>
                    <input type="text" id="numero_celular" name="numero" value="<?php echo $numero_celular; ?>" required disabled>
                    <input type="hidden" id="numero_celular" name="numero_celular" value="<?php echo $numero_celular; ?>" required>
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" id="fecha" name="fecha" value="<?php echo $fecha; ?>" required>
                </div>
                <div class="form-group">
                    <label for="socio">Socio</label>
                    <input type="text" id="socio" name="socio" value="<?php echo $socio; ?>" required disabled>
                    <input type="hidden" id="socio" name="socio" value="<?php echo $socio; ?>">
                </div>
                <div class="form-group">
                    <label for="tiempo">Tiempo Jugado</label>
                    <select id="tiempo" name="tiempo" required>
                        <option value="30" <?php echo $tiempo == 30 ? 'selected' : ''; ?>>30 minutos</option>
                        <option value="60" <?php echo $tiempo == 60 ? 'selected' : ''; ?>>1 hora</option>
                        <option value="90" <?php echo $tiempo == 90 ? 'selected' : ''; ?>>1 hora y 30 minutos</option>
                        <option value="120" <?php echo $tiempo == 120 ? 'selected' : ''; ?>>2 horas</option>
                        <option value="150" <?php echo $tiempo == 150 ? 'selected' : ''; ?>>2 horas y 30 minutos</option>
                        <option value="180" <?php echo $tiempo == 180 ? 'selected' : ''; ?>>3 horas</option>
                        <option value="210" <?php echo $tiempo == 210 ? 'selected' : ''; ?>>3 horas y 30 minutos</option>
                        <option value="240" <?php echo $tiempo == 240 ? 'selected' : ''; ?>>4 horas</option>
                        <option value="270" <?php echo $tiempo == 270 ? 'selected' : ''; ?>>4 horas y 30 minutos</option>
                        <option value="300" <?php echo $tiempo == 300 ? 'selected' : ''; ?>>5 horas</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="mesa">Mesa</label>
                    <select id="mesa" name="mesas_id_mesa" required>
                        <?php for ($i = 1; $i <= 12; $i++) {
                            echo "<option value='$i' " . ($mesa == $i ? 'selected' : '') . ">Mesa $i</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="monto">Monto</label>
                    <input type="text" id="monto" name="monto" value="<?php echo $monto; ?>" required disabled>
                    <input type="hidden" id="monto" name="monto" value="<?php echo $monto; ?>">
                </div>
                <div class="form-submit">
                    <button type="submit" name="Guardar_Cambios" value="Enviar">Actualizar Datos</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
<?php
}
?>
