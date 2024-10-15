<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
</head>
<body>
	<!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Gestión de Deportes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="listarEquipo.php">Listar Equipos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="insertarFrmEquipo.php">Crear Nuevo Equipo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="listarJugador.php">Listar Jugadores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="insertarFrmJugador.php">Crear Nuevo Jugador</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
	<?php
	$conexion=mysqli_connect("localhost","root","","campeonato");
	$codigoJ=$_REQUEST['codJ'];
	$borrar="delete from jugador where cod_j=".$codigoJ;
	mysqli_query($conexion,$borrar) or die ("Error... al eliminar jugador");
	echo "Eliminaste un Jugador... <br>
	<a href='listarJugador.php'>Volver a lista de Jugadores </a>";
	?>

</body>
</html>