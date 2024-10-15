<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Jugador</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
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
        <h1 class="text-center mb-4">Lista de Jugadores</h1>
        <?php
        $conexion = mysqli_connect('localhost', 'root', '', 'campeonato');

        // Consulta para obtener los datos del jugador y sus posiciones
        $consulta = "
    SELECT j.*, GROUP_CONCAT(p.nombre_pos SEPARATOR ', ') as posiciones
    FROM jugador j
    LEFT JOIN rel_ju_po rjp ON j.cod_j = rjp.cod_juga
    LEFT JOIN posicion p ON rjp.cod_posi = p.cod_pos
    GROUP BY j.cod_j
";

        $ejeConsulta = mysqli_query($conexion, $consulta) or die("Error al seleccionar jugadores.");
        $nroJugadores = mysqli_num_rows($ejeConsulta);
        ?>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Código Jugador</th>
                    <th>CI</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Sexo</th>
                    <th>Código Equipo</th>
                    <th>Posiciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($nroJugadores > 0) {
                    while ($jugador = mysqli_fetch_array($ejeConsulta)) {
                ?>
                        <tr>
                            <td><?php echo $jugador['cod_j']; ?></td>
                            <td><?php echo $jugador['ci']; ?></td>
                            <td><?php echo $jugador['nombre']; ?></td>
                            <td><?php echo $jugador['paterno']; ?></td>
                            <td><?php echo $jugador['materno']; ?></td>
                            <td><?php echo $jugador['fechaNac']; ?></td>
                            <td><?php echo $jugador['sexo']; ?></td>
                            <td><?php echo $jugador['codEquipo']; ?></td>
                            <td><?php echo $jugador['posiciones'] ? $jugador['posiciones'] : 'N/A'; ?></td>
                            <td>
                                <a href="editarJugador.php?codJ=<?php echo $jugador['cod_j']; ?>" class="btn btn-primary btn-sm d-inline">Editar</a>
                                <a href="eliminarJugador.php?codJ=<?php echo $jugador['cod_j']; ?>" class="btn btn-danger btn-sm d-inline">Eliminar</a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <p><a href="../index.html" class="btn btn-secondary">Volver al Menú Principal</a></p>
    </div>

    <!-- Bootstrap JS -->
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>
