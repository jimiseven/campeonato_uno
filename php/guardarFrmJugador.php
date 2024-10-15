<?php
    // Conexión a la base de datos
    $conexion = mysqli_connect('localhost', 'root', '', 'campeonato');

    // Recoger los datos del formulario
    $car = $_GET['cedula'];
    $nom = $_GET['nombre'];
    $pat = $_GET['ape_pat'];
    $mat = $_GET['ape_mat'];
    $fec = $_GET['fecha_nac'];
    $sex = $_GET['sexo'];
    $eq = $_GET['equi'];
    $po = $_GET['posicion']; // Posiciones seleccionadas (array)

    // Insertar los datos del jugador en la tabla jugador
    $insJug = "INSERT INTO jugador(ci, nombre, paterno, materno, fechaNac, sexo, codEquipo) 
               VALUES('$car', '$nom', '$pat', '$mat', '$fec', '$sex', '$eq')";
    mysqli_query($conexion, $insJug);

    // Recuperar el último ID del jugador insertado
    $id_jug_insertado = mysqli_insert_id($conexion);

    // Insertar las posiciones del jugador en la tabla rel_ju_po
    foreach($po as $posiciones) {
        $consulta = "INSERT INTO rel_ju_po (cod_posi, cod_juga) VALUES ($posiciones, $id_jug_insertado)";
        mysqli_query($conexion, $consulta);
    }

    // Redirigir a listarJugador.php después de insertar los datos
    header("Location: listarJugador.php");
    exit(); // Importante detener el script aquí después de la redirección
?>
