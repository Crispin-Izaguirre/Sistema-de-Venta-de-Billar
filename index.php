<?php
include("conexion.php");
$sql = "SELECT * FROM campeonato WHERE eliminado = 0";
$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados Billar Carambola</title>
    <link rel="stylesheet" href="estil.css">.
    <link rel="website icon" type="png" href="https://i.pinimg.com/originals/a0/21/ef/a021ef89da1de7f750cd72bd2b436083.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.php"><img src="https://www.sportbillarperu.com/wp-content/uploads/2022/06/oficial-wp.png" alt="Kozoom"></a>
        </div>
        <div class="auth">
            <a href="iniciar.php">INICIAR SESION</a>
        </div>
    </header>
    <main>
        <section class="results">
            <div class="padre">
                <h1>Resultados Billar Carambola</h1>
                <h2>Tres Bandas - Campeonato del Mundo - Lima (PER) - 12/07/11 al 16/07/11</h2>
                <table id="resultados">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        while($fila = mysqli_fetch_assoc($resultado)){
                    ?>
                        <tr>
                            <td><?php echo $fila['id_campeonato']; ?></td>
                            <td><?php echo $fila['nombre']; ?></td>
                            <td><?php echo $fila['fecha']; ?></td>
                            <td class="accion">
                                <?php echo "<a href='cam.php?id=".$fila['id_campeonato']."' class='button'>VER</a>"; ?>
                            </td>
                        </tr>
                    <?php 
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </section>
        <aside>
            <div class="premium">
                <p>¿Qué esperas? Participa!</p>
                <b>Ve con la recepcionista</b>
            </div>
            <div class="ranking">
                <h3>Reglas</h3>
                <p>No se permiten trampas</p>
                <p>No se permite el mal comportamiento</p>
                <p>Sin insultos</p>
                <p>Respeto ante todo</p>
            </div>
        </aside>
    </main>
    <footer>
        <p>&copy; 2024 El RICO. Todos los derechos reservados.</p>
    </footer>
</body>
</html>

<?php
mysqli_close($conexion);
?>
