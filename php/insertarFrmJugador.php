<?php
    $conexion=mysqli_connect('localhost','root','','campeonato');
    $sql_eq = "SELECT codEquipo, nombreEquipo FROM equipo";
    $equi = mysqli_query($conexion, $sql_eq);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Jugador</title>
    <!-- Bootstrap CSS -->
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
    <div class="container mt-5">
        <h1 class="text-center mb-4">Insertar Jugador</h1>
        <form action="guardarFrmJugador.php" method="get" class="row g-3">
            <div class="col-md-6">
                <label for="cedula" class="form-label">CI del Jugador</label>
                <input type="number" id="cedula" name="cedula" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre del Jugador</label>
                <input type="text" id="nombre" name="nombre" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="ape_pat" class="form-label">Apellido Paterno</label>
                <input type="text" id="ape_pat" name="ape_pat" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="ape_mat" class="form-label">Apellido Materno</label>
                <input type="text" id="ape_mat" name="ape_mat" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="fecha_nac" class="form-label">Fecha de Nacimiento</label>
                <input type="date" id="fecha_nac" name="fecha_nac" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Sexo</label>
                <div class="form-check">
                    <input type="radio" id="masculino" name="sexo" value="M" class="form-check-input">
                    <label for="masculino" class="form-check-label">Masculino</label>
                </div>
                <div class="form-check">
                    <input type="radio" id="femenino" name="sexo" value="F" class="form-check-input">
                    <label for="femenino" class="form-check-label">Femenino</label>
                </div>
            </div>
            <div class="col-md-6">
                <label for="equi" class="form-label">Equipo</label>
                <select id="equi" name="equi" class="form-select">
                    <option value="">elegir equipo</option>
                    <?php while($eq = mysqli_fetch_array($equi)) { 
                        echo "<option value='".$eq['codEquipo']."'>".$eq['codEquipo']." - ".$eq['nombreEquipo']."</option>";
                    } ?>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Posiciones en las que juega:</label><br>
                <div class="form-check">
                    <input type="checkbox" id="delantero" name="posicion[]" value="1" class="form-check-input">
                    <label for="delantero" class="form-check-label">Delantero</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" id="arquero" name="posicion[]" value="2" class="form-check-input">
                    <label for="arquero" class="form-check-label">Arquero</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" id="centro_campista" name="posicion[]" value="3" class="form-check-input">
                    <label for="centro_campista" class="form-check-label">Centro Campista</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" id="defensa" name="posicion[]" value="4" class="form-check-input">
                    <label for="defensa" class="form-check-label">Defensa</label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Guardar Jugador</button>
                <button type="reset" class="btn btn-secondary">Cancelar</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
