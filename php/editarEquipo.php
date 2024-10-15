<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
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
        $conexion=mysqli_connect('localhost','root','','campeonato');
        $cod=$_REQUEST['codEquipo'];
        $select="select codEquipo,nombreEquipo,fechaCreacion,color 
           from equipo where codEquipo=$cod";
        $select_ej=mysqli_query($conexion,$select) or die("...Error en la tabla equipo...");
        $valores=mysqli_fetch_array($select_ej);
    ?>
    <form action="guardarEditarEquipo.php" method="GET">
        <h2>Editar Equipo</h2>
        <h3>Codigo del Equipo : </h3>
        <input type="hidden" name="codEq" value="<?php echo $valores['codEquipo']?>">
        <h3>Nombre Equipo : </h3>
        <input type="text" name="nomEq" value="<?php echo $valores['nombreEquipo']?>">
        <h3>Fecha creación : </h3>
        <input type="date" name="fecha" value="<?php echo $valores['fechaCreacion']?>">
        <h3>Color : </h3>
        <input type="text" name="color" value="<?php echo $valores['color']?>"><br>
        <br>
        <input type="submit" value="Guardar Cambios">
        <input type="cancel" value="Cancelar">
    </form>
</body>
</html>