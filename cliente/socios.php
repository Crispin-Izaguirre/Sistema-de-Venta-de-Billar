<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:../index.php');
    exit;
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
    include("../conexion.php");
    // Lo usaremos para la selección de campos
    $sql = "SELECT * FROM clientes WHERE eliminado = 0 AND socio = 1 ";
    $resultado = mysqli_query($conexion, $sql);
?>
    <?php
    include("../navegacion/cliente.php");
    ?>
    <h1>Lista de Socios</h1>
    <form action="buscar_usuario1.php" method="POST" class="formulario_bus">
        <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
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
                while($filas=mysqli_fetch_assoc($resultado)){
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
                    <?php echo "<a href='editar.php?id=".$filas['id_cliente']."'>EDITAR</a>"; ?>
                    -
                    <?php echo "<a href='dejarsocio.php?id=".$filas['id_cliente']."'>QUITAR</a>"; ?>
                    
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
