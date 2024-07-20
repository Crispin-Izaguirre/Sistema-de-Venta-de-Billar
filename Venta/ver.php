<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:../index.php');
    exit;
}
?>
<?php
include("../conexion.php");

// Recuperar datos del cliente y de la venta
$id_cliente = $_GET['id'];
$sql = "SELECT v.*, a.name as name
        FROM ventas v
        INNER JOIN administradores a ON v.administradores_id_admin = a.id_admin
        WHERE v.id_venta = $id_cliente";
$resultado = mysqli_query($conexion, $sql);
$fila = mysqli_fetch_assoc($resultado);
// Nuestras sabrosas variables o mejor dicho datos xD
$nombre = $fila['Nombre'];
$apellidos = $fila['Apellidos'];
$numero_celular = $fila['Numero_celular'];
$DNI = $fila['DNI'];
$socio = $fila['socio'];
$monto = $fila['monto'];
$fecha = $fila['fecha'];
$mesa = $fila['mesas_id_mesa'];
$tiempo = $fila['tiempo'];
$nombre_admin = $fila['name'];

mysqli_close($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Compra</title>
    <link rel="stylesheet" href="../estilos/registro1.css">
    <link rel="icon" type="image/png" href="https://i.pinimg.com/originals/a0/21/ef/a021ef89da1de7f750cd72bd2b436083.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include("../navegacion/venta.php") ?>

    <div class="form-container">
        <h2>Detalles de Compra</h2>
        <form action="#" method="POST" enctype="multipart/form-data" class="formulario" disabled>
            <div class="logo-container">
                <img src="https://www.sportbillarperu.com/wp-content/uploads/2022/06/oficial-wp.png" alt="Logo">
            </div>
            <div class="form-content">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required disabled>
                </div>
                <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" id="apellidos" name="apellidos" value="<?php echo $apellidos; ?>" required disabled>
                </div>
                <div class="form-group">
                    <label for="dni">DNI</label>
                    <input type="text" id="dni" name="dni" value="<?php echo $DNI; ?>" required disabled>
                </div>
                <div class="form-group">
                    <label for="numero_celular">Número de Celular</label>
                    <input type="text" id="numero_celular" name="numero_celular" value="<?php echo $numero_celular; ?>" required disabled>
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" id="fecha" name="fecha" value="<?php echo $fecha; ?>" required disabled>
                </div>
                <div class="form-group">
                    <label for="socio">Socio</label>
                    <input type="text" id="socio" name="socio" value="<?php echo $socio; ?>" required disabled>
                </div>
                <div class="form-group">
                    <label for="tiempo">Tiempo Jugado</label>
                    <input type="text" id="tiempo" name="tiempo" value="<?php echo $tiempo; ?>" required disabled>
                </div>
                <div class="form-group">
                    <label for="mesa">Mesa</label>
                    <input type="text" id="mesa" name="mesa" value="<?php echo $mesa; ?>" required disabled>
                </div>
                <div class="form-group">
                    <label for="monto">Monto</label>
                    <input type="text" id="monto" name="monto" value="<?php echo $monto; ?>" required disabled>
                </div>
                <div class="form-group">
                    <label for="admin_responsable">Administrador Responsable</label>
                    <input type="text" id="admin_responsable" name="admin_responsable" value="<?php echo $nombre_admin; ?>" required disabled>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
