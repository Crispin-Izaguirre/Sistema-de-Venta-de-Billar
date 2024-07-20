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
    
    $sql = "SELECT * FROM campeonato
            WHERE eliminado =0 AND (nombre LIKE '%$busqueda%' OR fecha LIKE '%$busqueda%' OR descripcion LIKE '%$busqueda%' OR id_campeonato LIKE '%$busqueda%')";
} else {
    $sql = "SELECT * FROM campeonato";
}

$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar participante</title>
    <link rel="stylesheet" href="../prueba.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="website icon" type="png" href="https://i.pinimg.com/originals/a0/21/ef/a021ef89da1de7f750cd72bd2b436083.png">
</head>
<body>
    <?php
            include("../navegacion/campeonato.php");
        ?>
    <h1>Lista de participantes del campeonato</h1>
    <form action="buscar_campeonato.php" method="POST" class="formulario_bus">
        <input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo htmlspecialchars($busqueda); ?>" required>
        <input type="submit" value="Buscar" class="boton_bus">
    </form>
    <table class="tabla_principal">
        <thead>
        <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                while($filas=mysqli_fetch_assoc($resultado)){
            ?>
            <tr>
                <td> <?php echo $filas['id_campeonato']; ?> </td>
                <td> <?php echo $filas['nombre']; ?> </td>
                <td> <?php echo $filas['fecha']; ?> </td>
                <td> <?php echo $filas['descripcion']; ?> </td>
                <td class="accion">
                    <?php echo "<a href='editar_campeonato.php?id=".$filas['id_campeonato']."'>EDITAR</a>"; ?>
                    -
                    <?php echo "<a href='subir_campeonato.php?id=".$filas['id_campeonato']."'>CALIFICAR</a>"; ?>
                    -
                    <?php echo "<a href='../cliente/descalificar.php?id=" . $filas['id_campeonato'] . "' onclick='return confirm(\"¿Está seguro de que desea descalificar a este participante?\");'>DESCALIFICAR</a>";?>
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
