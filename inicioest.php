<?php
  session_start();

  include_once 'conexion.php';	
			
			$documento = $_POST['documento'];
            
            $todosLosDatos = $conex->prepare('SELECT * FROM usuario WHERE codigo = :codigo');
            $todosLosDatos->bindParam(':codigo', $_POST['codigo']);
            $todosLosDatos->execute();
            $resultado=$todosLosDatos->fetch(PDO::FETCH_ASSOC);
          
            
			
			if ($resultado > 0) {	
				$idEstudiante=$resultado['id'];
				$_SESSION['loggedin'] = true;
				$_SESSION['name'] = $resultado['nombres'];
				$_SESSION['start'] = time();
				$_SESSION['expire'] = $_SESSION['start'] + (1 * 60) ;						
				
				echo "<div class='alert alert-success mt-4' role='alert'><strong>Welcome!</strong> $resultado[nombres]	
				<p><a href='salir.php'>Cerrar sesion</a></p></div>";	
			
			} else {
        echo "<div class='alert alert-danger mt-4' role='alert'>Documento o codigo son incorrectos!
        seras devuelto al login
        <p><a href='inicioest.html'><strong>Volver a intentarlo</strong></a></p></div>";
        header( "refresh:2;url=iniciodoc.html" );				
      }	
      
    $todosLosDatos2 = $conex->prepare('SELECT * FROM materia WHERE estudiante = :id ORDER BY id DESC');
    $todosLosDatos2->bindParam(':id', $idEstudiante);
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
 
      <h1>Materias y calificaciones</h1>

      <table>
        <tr class="tituloDeColumnas">
            <td>Materia</td>
            <td>Creditos</td>
            <td>Nota 1</td>
            <td>Nota 2</td>
            <td>Nota 3</td>
            <td>Nota 4</td>
            <td>Observaciones</td>
        </tr>
        <?php foreach($resultado2 as $rtd):?>
        <tr>
            <td><?php echo $rtd['nombre']; ?></td>
            <td><?php echo $rtd['creditos']; ?></td>
            <td><?php echo $rtd['nota_1']; ?></td>
            <td><?php echo $rtd['nota_2']; ?></td>
            <td><?php echo $rtd['nota_3']; ?></td>
            <td><?php echo $rtd['nota_4']; ?></td>
            <td><?php echo $rtd['observacion']; ?></td>
        </tr>
        <?php endforeach ?>
    </table>    
  </body>
</html>