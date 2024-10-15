<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Jugador</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
</head>
<body>
    <?php
        $conexion = mysqli_connect('localhost', 'root', '', 'campeonato');
        $codi = $_REQUEST['codJ'];

        $select = "SELECT * FROM jugador WHERE cod_j = $codi";
        $ejecuta_jug = mysqli_query($conexion, $select) or die("Error... en la tabla Jugador");
        $equipo = mysqli_fetch_array($ejecuta_jug);		

        $equi = $equipo['codEquipo'];

        $consul_E = "SELECT codEquipo, nombreEquipo FROM equipo ORDER BY codEquipo ASC";
        $ejecuta_E = mysqli_query($conexion, $consul_E) or die ("..Error al seleccionar Club...");
        
        // Consulta posiciones
        $consulta_Pos = "SELECT cod_posi FROM rel_ju_po WHERE cod_juga = $codi";
        $ejecuta_Pos = mysqli_query($conexion, $consulta_Pos) or die(".. Error al seleccionar posicion...");

        $posicion = array();

        // Generamos un array asociativo en base a las posiciones recuperadas
        while ($c = mysqli_fetch_assoc($ejecuta_Pos)) {
            $posicion[] = $c['cod_posi'];
        }
    ?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Editar Jugador</h1>
        <form action="guardarEditarJugador.php" method="GET" class="row g-3">
            <div class="col-md-6">
                <label for="codi" class="form-label">Código</label>
                <input type="number" id="codi" name="codi" value="<?php echo $equipo['cod_j'] ?>" class="form-control" readonly>
            </div>
            <div class="col-md-6">
                <label for="ci" class="form-label">CI</label>
                <input type="number" id="ci" name="ci" value="<?php echo $equipo['ci'] ?>" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $equipo['nombre'] ?>" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="Ap_Paterno" class="form-label">Apellido Paterno</label>
                <input type="text" id="Ap_Paterno" name="Ap_Paterno" value="<?php echo $equipo['paterno'] ?>" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="Ap_Materno" class="form-label">Apellido Materno</label>
                <input type="text" id="Ap_Materno" name="Ap_Materno" value="<?php echo $equipo['materno'] ?>" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="fechaNac" class="form-label">Fecha de Nacimiento</label>
                <input type="date" id="fechaNac" name="fechaNac" value="<?php echo $equipo['fechaNac'] ?>" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Sexo</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sexo" value="M" <?php if($equipo['sexo'] == "M") echo "checked"; ?>>
                    <label class="form-check-label">Varón</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sexo" value="F" <?php if($equipo['sexo'] == "F") echo "checked"; ?>>
                    <label class="form-check-label">Mujer</label>
                </div>
            </div>
            <div class="col-md-6">
                <label for="c_equipo" class="form-label">Equipo</label>
                <select id="c_equipo" name="c_equipo" class="form-select">
                    <?php
                        while ($fila = mysqli_fetch_array($ejecuta_E)) {
                            $coEqui = $fila['codEquipo'];
                            $nomEqui = $fila['nombreEquipo'];
                            if ($coEqui == $equi) {
                                echo "<option value='$coEqui' selected>$coEqui - $nomEqui</option>";
                            } else {
                                echo "<option value='$coEqui'>$coEqui - $nomEqui</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Posición</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" <?php if (in_array("1", $posicion)) echo 'checked'; ?> name="posicion[]">
                    <label class="form-check-label">Delantero</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="2" <?php if (in_array("2", $posicion)) echo 'checked'; ?> name="posicion[]">
                    <label class="form-check-label">Arquero</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="3" <?php if (in_array("3", $posicion)) echo 'checked'; ?> name="posicion[]">
                    <label class="form-check-label">Centro Campista</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="4" <?php if (in_array("4", $posicion)) echo 'checked'; ?> name="posicion[]">
                    <label class="form-check-label">Defensa</label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
