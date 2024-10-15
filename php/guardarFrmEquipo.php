<?php
    // Conexión a la base de datos
    $conexion = mysqli_connect('localhost', 'root', '', 'campeonato');

    // Recoger los datos del formulario
    $nom = $_GET['nomEq'];
    $fec = $_GET['fecha'];
    $col = $_GET['color'];

    // Insertar el equipo en la base de datos
    $creEq = "INSERT INTO equipo(nombreEquipo, fechaCreacion, color) VALUES('$nom', '$fec', '$col')";

    // Comprobar si la inserción fue exitosa
    if ($conexion->query($creEq) === true) {
        // Redireccionar a la lista de equipos después de guardar el equipo
        header("Location: listarEquipo.php");
        exit(); // Importante para detener la ejecución después de la redirección
    } else {
        // Mostrar el error en caso de fallo
        die("Error al insertar el equipo: " . $conexion->error);
    }
?>
