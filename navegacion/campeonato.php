<nav class="nav">
        <div class="nav-div">
            <a href="../index1.php">
                <img src="https://www.sportbillarperu.com/wp-content/uploads/2022/06/oficial-wp.png" alt="Rudy's Logo">
            </a>
            <ul class="nav-list">
                <li class="nav-list-e">
                    <a>Bienvenido <?=$_SESSION['name'];?></a>
                    <ul>
                        <li><a href="../cerrar_sesion.php">Cerrar sesion</a></li>
                    </ul>
                </li>
                <div class="navegacion">
                    <a href="../cliente/register.php">Administrador</a>
                    <a href="../Venta/RegistrarAlquiler.php">Registrar Alquiler</a>
                    <a href="../cliente/historial.php">Historial</a>
                </div>
                <li class="nav-list-e">
                    <a href="../index1.php" class="model1">Nuestros Clientes</a>
                    <ul>
                        <li><a href="../cliente/agregar.php">Nuevo cliente</a></li>
                        <li><a href="../cliente/socios.php">Socios</a></li>
                        <li><a href="../cliente/cliente_eliminado.php">Clientes vetados</a></li>
                    </ul>
                </li>
                <li class="nav-list-e 2">
                    <a href="campeonato.php">Campeonatos</a>
                    <ul class="model2">
                        <li><a href="agregar_campeonato.php">Agregar</a></li>
                        <li><a href="consulta.php">Participante</a></li>
                        
                    </ul>
                </li>
            </ul>
        </div>
    </nav>