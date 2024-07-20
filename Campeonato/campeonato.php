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
    $_SESSION['name'];
    $_SESSION['username'];
    // Lo usaremos para la selección de campos
    $sql = "SELECT * FROM campeonato WHERE eliminado=0";
    $resultado = mysqli_query($conexion, $sql);
?>
    <?php
        include("../navegacion/campeonato.php");
    ?>
    <h1>Campeonatos</h1>
    <form action="buscar_campeonato.php" method="POST" class="formulario_bus">
        <input type="text" name="busqueda" id="busqueda" placeholder="Buscar" required>
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
                    <?php echo "<a href='visualizar_participante.php?id=".$filas['id_campeonato']."'>VER</a>"; ?>
                    -
                    <?php echo "<a href='editar.php?id=".$filas['id_campeonato']."'>EDITAR</a>"; ?>
                    -
                    <?php echo "<a href='estado_campeonato.php?id=".$filas['id_campeonato']."'>ESTADO</a>"; ?>
                    -
                    <?php echo "<a href='../cliente/descalificar.php?id=" . $filas['id_campeonato'] . "' onclick='return confirm(\"¿Está seguro de que desea eliminar este campeonato?\");'>ELIMINAR</a>";?>

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
