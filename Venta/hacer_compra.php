<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:../index.php');
    exit;
}
?>
<?php
include("../conexion.php");
// para enviar nuestros datosS
if (isset($_POST['Guardar_Cambios'])) {
    $id_cliente = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $numero_celular = $_POST['numero_celular'];
    $DNI = $_POST['dni'];
    $fecha = $_POST['fecha'];
    $mesas_id_mesa = $_POST['mesa'];
    $administradores_id_admin = $_SESSION['admin_id'];
    $tiempo = $_POST['tiempo'];
    $es = $_POST['socio'];
    $socio = $_POST['socio'];
    if ($socio == "Es un socio") {
        $monto = (intval($tiempo) / 30) * 3;
    } else {
        $monto = (intval($tiempo) / 30) * 4;
    }
    $sql = "INSERT INTO ventas (Nombre, Apellidos, Numero_celular, DNI, fecha, monto, socio, mesas_id_mesa, clientes_id_cliente, administradores_id_admin, tiempo) 
            VALUES ('$nombre', '$apellidos', '$numero_celular', '$DNI', '$fecha', '$monto', '$es', '$mesas_id_mesa', '$id_cliente', '$administradores_id_admin', '$tiempo')";
    $resultado = mysqli_query($conexion, $sql);
    if ($resultado) {
        echo "<script language='JavaScript'>
                alert('Se realizó la compra correctamente');
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
    // Recuperamos los datos del cliente para mostrar en el formulario
    $id_cliente = $_GET['id'];
    $sql = "SELECT * FROM clientes WHERE id_cliente = $id_cliente";
    $resultado = mysqli_query($conexion, $sql);
    $fila = mysqli_fetch_assoc($resultado);
    $nombre = $fila['Nombre'];
    $apellidos = $fila['Apellidos'];
    $numero_celular = $fila['Numero_celular'];
    $DNI = $fila['DNI'];
    $socio = $fila['socio'];

    // Osea me dio flojera para hacer mas y solo hice un if God
    if ($socio == 1) {
        $mensaje_socio = "Es un socio";
    } else {
        $mensaje_socio = "No es un socio";
    }

    mysqli_close($conexion);
?>
    
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Compra</title>
    <link rel="stylesheet" href="../estilos/registro1.css">
    <link rel="website icon" type="png" href="https://i.pinimg.com/originals/a0/21/ef/a021ef89da1de7f750cd72bd2b436083.png">
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
            <!--Obvio hay variables que no podemos mutar del cliente por eso bloqueado y lo guardamos en una input invisible xD-->
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
                    <input type="text" id="numero_celular" name="numero_cel" value="<?php echo $numero_celular; ?>" required disabled>
                    <input type="hidden" id="numero_celular" name="numero_celular" value="<?php echo $numero_celular; ?>" required>
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" id="fecha" name="fecha" required>
                </div>
                <div class="form-group">
                    <label for="socio">Socio</label>
                    <input type="text" id="socio" name="so" value="<?php echo $mensaje_socio; ?>" required disabled>
                    <input type="hidden" id="socio" name="socio" value="<?php echo $mensaje_socio; ?>" required>
                </div>
                <div class="form-group">
                    <label for="mesa">Mesa</label>
                    <select id="mesa" name="mesa" required>
                        <?php for ($i = 1; $i <= 12; $i++) {
                            echo "<option value='$i'>Mesa $i</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tiempo">Tiempo Jugado</label>
                    <select id="tiempo" name="tiempo" required>
                        <option value="30">30 minutos</option>
                        <option value="60">1 hora</option>
                        <option value="90">1 hora y 30 minutos</option>
                        <option value="120">2 horas</option>
                        <option value="150">2 horas y 30 minutos</option>
                        <option value="180">3 horas</option>
                        <option value="210">3 horas y 30 minutos</option>
                        <option value="240">4 horas</option>
                        <option value="270">4 horas y 30 minutos</option>
                        <option value="300">5 horas</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="hidden" id="monto" name="monto" value="<?php echo isset($monto) ? $monto : ''; ?>" required disabled>
                    <input type="hidden" id="monto" name="monto" value="<?php echo isset($monto) ? $monto : ''; ?>" required>
                </div>
                <div class="form-submit">
                    <button type="submit" name="Guardar_Cambios" value="Enviar">Realizar Compra</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
<?php
}
?>
