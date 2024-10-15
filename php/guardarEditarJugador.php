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
		$cd=$_REQUEST['codi'];
		$carnet=$_REQUEST['ci'];
		$nom=$_REQUEST['nombre'];
		$apPat=$_REQUEST['Ap_Paterno'];
		$apMat=$_REQUEST['Ap_Materno'];
		$fechanac=$_REQUEST['fechaNac'];
		$sexo=$_REQUEST['sexo'];
		$codEquipo=$_REQUEST['c_equipo'];
		$posi=$_REQUEST['posicion'];
		$consulta="update jugador set ci='$carnet', nombre='$nom', paterno='$apPat', materno='$apMat', fechaNac='$fechanac', sexo='$sexo', codEquipo='$codEquipo' where cod_j=$cd";
		if (isset($_GET['posicion'])){
				$posi=$_GET['posicion'];
		} else {
				"<br>posicion  no es un arreglo<br>";
		}
		if($c_ejecutada=mysqli_query($conexion,$consulta)){
			if(!isset($posi)){
				$longitud=0;
			} else {
				$longitud=count($posi);				
			}
			$consul_rel="select * from rel_ju_po where cod_juga=$cd";
			$rel_ej=mysqli_query($conexion,$consul_rel);
			$numElemRelJug=mysqli_num_rows($rel_ej);

			if($numElemRelJug>0){

				while($c=mysqli_fetch_assoc($rel_ej)){
					if($longitud>0){
						if(!(in_array($c['cod_posi'],$posi,true))){
							$consulta="delete from rel_ju_po where(cod_juga=$cd and cod_posi=".$c['cod_posi'].")";
							mysqli_query($conexion,$consulta);
						}
					}else{
						if($longitud<=0){
							$consulta="delete from rel_ju_po where(cod_juga=$cd and cod_posi=".$c['cod_posi'];
							mysqli_query($conexion,$consulta);
						}
					}
				}
				$long=$longitud;
				for($i=0;$i<$long;$i++){
					$contador=0;
					$rel_ej_1=mysqli_query($conexion,$consul_rel);
					while($c1=mysqli_fetch_assoc($rel_ej_1)){
						//if($posi[$i]===$c1['cod_juga']){
						if($posi[$i]===$c1['cod_posi']){
							$contador++;
						}
					}
					mysqli_free_result($rel_ej_1);
					if($contador<1){
						$consulta="insert into rel_ju_po set cod_posi=".$posi[$i].", cod_juga='$cd'";
						mysqli_query($conexion,$consulta);
					}
				}
			}else{
				foreach($_GET['posicion'] as $idposicion){
					$consulta="insert into rel_ju_po set cod_posi='$idposicion', cod_juga='$cd'";
					mysqli_query($conexion,$consulta);
				}
			}
			echo "<br>Modificaste Jugador <br><br> <a href='listarJugador.php'>Listar Jugador </a>";
		}
		else{
			echo "Error... en Guardar cambios de editar";
		}
	?>
</body>
</html>