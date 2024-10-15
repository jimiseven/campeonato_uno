<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Equipo</title>
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
        <h1 class="text-center mb-4">Lista de Equipos</h1>
        <?php
        $conexion = mysqli_connect('localhost', 'root', '', 'campeonato');
        $consulta = "SELECT * FROM equipo";
        $ejeConsulta = mysqli_query($conexion, $consulta) or die("...Error al seleccionar Equipo...");
        $nroEquipos = mysqli_num_rows($ejeConsulta);
        ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Código Equipo</th>
                    <th>Nombre</th>
                    <th>Fecha Creación</th>
                    <th>Color</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($nroEquipos > 0) {
                    for ($i = 0; $i < $nroEquipos; $i++) {
                        $equipo = mysqli_fetch_array($ejeConsulta);
                ?>
                        <tr>
                            <td><?php echo $equipo['codEquipo']; ?></td>
                            <td><?php echo $equipo['nombreEquipo']; ?></td>
                            <td><?php echo $equipo['fechaCreacion']; ?></td>
                            <td><?php echo $equipo['color']; ?></td>
                            <td>
                                <a href="editarEquipo.php?codEquipo=<?php echo $equipo['codEquipo']; ?>" class="btn btn-primary btn-sm">Editar</a>
                                <a href="eliminarEquipo.php?codEquipo=<?php echo $equipo['codEquipo']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>