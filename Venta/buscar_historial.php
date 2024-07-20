<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:../index.php');
    exit;
}
?>
<?php
include("../conexion.php");

$busqueda = '';

if (isset($_POST['busqueda'])) {
    $busqueda = mysqli_real_escape_string($conexion, $_POST['busqueda']);

    $sql = "SELECT * FROM ventas
            WHERE Nombre LIKE '%$busqueda%' OR Apellidos LIKE '%$busqueda%' OR DNI LIKE '%$busqueda%' OR Numero_celular LIKE '%$busqueda%' OR fecha LIKE '%$busqueda%' OR monto LIKE '%$busqueda%'";

} else {
    $sql = "SELECT * FROM ventas";
}

$resultado = mysqli_query($conexion, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de ventas</title>
    <link rel="stylesheet" href="../prueba.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="website icon" type="png" href="https://i.pinimg.com/originals/a0/21/ef/a021ef89da1de7f750cd72bd2b436083.png">
</head>
<body>
    <?php
        include("../navegacion/venta.php")
    ?>
    <h1>Historial de Ventas</h1>
    <form action="buscar_historial.php" method="POST" class="formulario_bus">
        <input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo htmlspecialchars($busqueda); ?>" required>
        <input type="submit" value="Buscar" class="boton_bus">
    </form>
    <table class="tabla_principal">
        <thead>
            <tr>
                <th>ID Venta</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>DNI</th>
                <th>Número de celular</th>
                <th>Fecha</th>
                <th>Monto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                while($filas=mysqli_fetch_assoc($resultado)){
            ?>
            <tr>
                <td> <?php echo $filas['id_venta']; ?> </td>
                <td> <?php echo $filas['Nombre']; ?> </td>
                <td> <?php echo $filas['Apellidos']; ?> </td>
                <td> <?php echo $filas['DNI']; ?> </td>
                <td> <?php echo $filas['Numero_celular']; ?> </td>
                <td> <?php echo $filas['fecha']; ?> </td>
                <td> <?php echo $filas['monto']; ?> </td>
                <td class="accion">
                    <?php echo "<a href='editar_historial.php?id=".$filas['id_venta']."'>EDITAR</a>"; ?>
                    
                </td>
            </tr>
            <?php 
                }
            ?>
        </tbody>
    </table>
    <?php
        mysqli_close($conexion);
    ?>
</body>
</html>
