<?php
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('location: camp.php');
    exit;
}

$id_campeonato = $_GET['id'];
include("conexion.php");

$sql_campeonato = "SELECT * FROM campeonato WHERE id_campeonato = $id_campeonato";
$resultado_campeonato = mysqli_query($conexion, $sql_campeonato);
$campeonato = mysqli_fetch_assoc($resultado_campeonato);

$sql_cuartos = "SELECT p.Nombre, p.Apellidos, p.Foto, c.campeonato_id_campeonato 
                FROM cuartos_final c
                JOIN participante p ON c.participante_id_participante = p.id_participante
                WHERE c.campeonato_id_campeonato = $id_campeonato";
$resultado_cuartos = mysqli_query($conexion, $sql_cuartos);

$sql_semi = "SELECT p.Nombre, p.Apellidos, p.Foto, s.campeonato_id_campeonato 
             FROM semi_final s
             JOIN participante p ON s.participante_id_participante = p.id_participante
             WHERE s.campeonato_id_campeonato = $id_campeonato";
$resultado_semi = mysqli_query($conexion, $sql_semi);

$sql_final = "SELECT p.Nombre, p.Apellidos, p.Foto, f.campeonato_id_campeonato 
              FROM final f
              JOIN participante p ON f.participante_id_participante = p.id_participante
              WHERE f.campeonato_id_campeonato = $id_campeonato";
$resultado_final = mysqli_query($conexion, $sql_final);

$sql_ganador = "SELECT p.Nombre, p.Apellidos, p.Foto, g.campeonato_id_campeonato 
                FROM ganadores g
                JOIN participante p ON g.participante_id_participante = p.id_participante
                WHERE g.campeonato_id_campeonato = $id_campeonato";
$resultado_ganador = mysqli_query($conexion, $sql_ganador);

// Cerrar la conexión al finalizar todo el procesamiento
mysqli_close($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado del Campeonato</title>
    <link rel="stylesheet" href="stylet2.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="website icon" type="png" href="https://i.pinimg.com/originals/a0/21/ef/a021ef89da1de7f750cd72bd2b436083.png">
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.php"><img src="https://www.sportbillarperu.com/wp-content/uploads/2022/06/oficial-wp.png" alt="Kozoom"></a>
        </div>
        <div class="auth">
            <a href="index.php">VOLVER</a>
            <a href="iniciar.php">INICIAR SESIÓN</a>
        </div>
    </header>
    <main>
        <section class="results">
            <div class="padre">
                <h1>Estado del Campeonato: <?php echo htmlspecialchars($campeonato['nombre']); ?></h1>
                <br><br>
                <h2>Cuartos de Final</h2>
                <table class="tabla_principal">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>ID Campeonato</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($fila = mysqli_fetch_assoc($resultado_cuartos)) { ?>
                            <tr>
                                <td><img src="data:image/jpeg;base64,<?php echo base64_encode($fila['Foto']); ?>" alt="Foto de Cliente" width="70" height="70" class="transfor"></td>
                                <td><?php echo htmlspecialchars($fila['Nombre']); ?></td>
                                <td><?php echo htmlspecialchars($fila['Apellidos']); ?></td>
                                <td><?php echo htmlspecialchars($fila['campeonato_id_campeonato']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br><br>
                <h2>Semifinal</h2>
                <table class="tabla_principal">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>ID Campeonato</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($fila = mysqli_fetch_assoc($resultado_semi)) { ?>
                            <tr>
                                <td><img src="data:image/jpeg;base64,<?php echo base64_encode($fila['Foto']); ?>" alt="Foto de Cliente" width="70" height="70" class="transfor"></td>
                                <td><?php echo htmlspecialchars($fila['Nombre']); ?></td>
                                <td><?php echo htmlspecialchars($fila['Apellidos']); ?></td>
                                <td><?php echo htmlspecialchars($fila['campeonato_id_campeonato']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br><br>
                <h2>Final</h2>
                <table class="tabla_principal">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>ID Campeonato</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($fila = mysqli_fetch_assoc($resultado_final)) { ?>
                            <tr>
                                <td><img src="data:image/jpeg;base64,<?php echo base64_encode($fila['Foto']); ?>" alt="Foto de Cliente" width="70" height="70" class="transfor"></td>
                                <td><?php echo htmlspecialchars($fila['Nombre']); ?></td>
                                <td><?php echo htmlspecialchars($fila['Apellidos']); ?></td>
                                <td><?php echo htmlspecialchars($fila['campeonato_id_campeonato']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br><br>
                <h2>Ganador</h2>
                <table class="tabla_principal">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>ID Campeonato</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($fila = mysqli_fetch_assoc($resultado_ganador)) { ?>
                            <tr>
                                <td><img src="data:image/jpeg;base64,<?php echo base64_encode($fila['Foto']); ?>" alt="Foto de Cliente" width="70" height="70" class="transfor"></td>
                                <td><?php echo htmlspecialchars($fila['Nombre']); ?></td>
                                <td><?php echo htmlspecialchars($fila['Apellidos']); ?></td>
                                <td><?php echo htmlspecialchars($fila['campeonato_id_campeonato']); ?></td>
                            </tr>
                        <?php } ?>
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
