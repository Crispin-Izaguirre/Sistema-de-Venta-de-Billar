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
    
    $sql = "SELECT * FROM clientes WHERE eliminado = 0 
            AND (Nombre LIKE '%$busqueda%' OR Apellidos LIKE '%$busqueda%' OR DNI LIKE '%$busqueda%' OR Numero_celular LIKE '%$busqueda%')";
} else {
    $sql = "SELECT * FROM clientes WHERE eliminado = 0 AND socio = 0";
}

$resultado = mysqli_query($conexion, $sql);

// Verifica si hubo algún error en la consulta
if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de clientes</title>
    <link rel="stylesheet" href="../prueba.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="website icon" type="png" href="https://i.pinimg.com/originals/a0/21/ef/a021ef89da1de7f750cd72bd2b436083.png">
</head>
<body>
    <?php
        include("../navegacion/cliente.php")
    ?>
    <h1>Agregar Nueva Venta</h1>
    <form action="consulta_registro.php" method="POST" class="formulario_bus">
        <input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo htmlspecialchars($busqueda); ?>">
        <input type="submit" value="Buscar" class="boton_bus">
    </form>
    <table class="tabla_principal">
        <thead>
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>DNI</th>
                <th>Celular</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            while($filas = mysqli_fetch_assoc($resultado)){
                $foto = base64_encode($filas['Foto']);
            ?>
            <tr>
                <td> <?php echo $filas['id_cliente']; ?> </td>
                <td><img src="data:image/jpeg;base64,<?php echo $foto; ?>" alt="Foto de Cliente" width="70" height="70" class="transfor"></td>
                <td> <?php echo $filas['Nombre']; ?> </td>
                <td> <?php echo $filas['Apellidos']; ?> </td>
                <td> <?php echo $filas['DNI']; ?> </td>
                <td> <?php echo $filas['Numero_celular']; ?> </td>
                <td class="accion">
                    <?php echo "<a href='../Venta/hacer_compra.php?id=".$filas['id_cliente']."'>AGREGAR COMPRA</a>"; ?>
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
