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
    <link rel="stylesheet" href="../estilos/registro1.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="website icon" type="png" href="https://i.pinimg.com/originals/a0/21/ef/a021ef89da1de7f750cd72bd2b436083.png">
</head>
<body>
    <?php
        include("../conexion.php");
    ?>
    <?php
    include("../navegacion/venta.php");
    ?>
    <h1>Agregar Nueva Venta</h1>
    <form action="../cliente/consulta_registro.php" method="POST" class="formulario_bus">
        <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
        <input type="submit" value="Buscar" class="boton_bus">
    </form>
    <div class="form-container">
        <h2>Boleta de Venta</h2>
        <form>
            <!--Un simple formulario para presentar-->
            <div class="logo-container">
                <img src="https://www.sportbillarperu.com/wp-content/uploads/2022/06/oficial-wp.png" alt="Logo">
            </div>
            <div class="form-content">
                <div class="form-group">
                    <label for="id_cliente">ID Cliente</label>
                    <input type="text" id="id_cliente" name="id_cliente" required disabled>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" required disabled>
                </div>
                <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" id="apellidos" name="apellidos" required disabled>
                </div>
                <div class="form-group">
                    <label for="dni">DNI</label>
                    <input type="text" id="dni" name="dni" required disabled>
                </div>
                <div class="form-group">
                    <label for="numero_celular">Número de Celular</label>
                    <input type="text" id="numero_celular" name="numero_celular" required disabled>
                </div>
                <div class="form-submit">
                    <button type="submit" disabled>Enviar</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
