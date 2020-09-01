<?php
  session_start();

  include_once 'conexion.php';	
			
			$documento = $_POST['documento'];
            
            $todosLosDatos = $conex->prepare('SELECT * FROM usuario WHERE codigo = :codigo');
            $todosLosDatos->bindParam(':codigo', $_POST['codigo']);
            $todosLosDatos->execute();
            $resultado=$todosLosDatos->fetch(PDO::FETCH_ASSOC);
   
			if ($resultado > 0) {	
				$idDocente=$resultado['id'];
				$_SESSION['loggedin'] = true;
				$_SESSION['name'] = $resultado['nombres'];
				$_SESSION['start'] = time();
				$_SESSION['expire'] = $_SESSION['start'] + (1 * 60) ;						
				
				echo "<div class='alert alert-success mt-4' role='alert'><strong>Welcome!</strong> $resultado[nombres]
				<p><a href='salir.php'>Cerrar Sesion</a></p></div>";	
			
			} else {
        echo "<div class='alert alert-danger mt-4' role='alert'>Documento o Correo fueron incorrectos!
        seras devuelto al longin
        <p><a href='iniciodoc.html'><strong>Favor intente de nuevo</strong></a></p></div>";	
        header( "refresh:2;url=iniciodoc.html" );	
      }	
      
    $todosLosDatos2 = $conex->prepare('SELECT usuario.nombres, materia.nombre, materia.nota_1, materia.nota_2, materia.nota_3, materia.nota_4, materia.observacion FROM materia INNER JOIN usuario ON materia.estudiante = usuario.id where materia.docente = :id ');
    $todosLosDatos2->bindParam(':id', $idDocente);
    $todosLosDatos2->execute();
    $resultado2=$todosLosDatos2->fetchAll();
   
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>LOL</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    
      <h1>Estudiantes y materias asignadas</h1>

      <table>
        <tr class="tituloDeColumnas">
            <td>Estudiante</td>
            <td>materia</td>
            <td>Nota 1</td>
            <td>Nota 2</td>
            <td>Nota 3</td>
            <td>Nota 4</td>
            <td>Observaciones</td>
        </tr>
          <?php foreach($resultado2 as $row):?>
        <tr>
            <td><?php echo $row['nombres']; ?></td>
            <td><?php echo $row['nombre']; ?></td>
            <td><?php echo $row['nota_1']; ?></td>
            <td><?php echo $row['nota_2']; ?></td>
            <td><?php echo $row['nota_3']; ?></td>
            <td><?php echo $row['nota_4']; ?></td>
            <td><?php echo $row['observacion']; ?></td>
        </tr>  
        <?php endforeach ?>
    </table>
      
  </body>
</html>