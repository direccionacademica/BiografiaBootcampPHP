<?php

include_once 'conexion.php';
    
if(isset($_POST['registro'])){
        $nombre=$_POST['nombre'];
        $apellido=$_POST['apellido'];
        $documento=$_POST['documento'];
        $codigo=$_POST['codigo'];
        $edad=$_POST['edad'];
        $telefono=$_POST['telefono'];
        $correo=$_POST['correo'];
        $rol=$_POST['rol'];

        

        if(!empty($nombre) && !empty($apellido) && !empty($documento) && !empty($codigo) && !empty($edad) && !empty($telefono) && !empty($correo) && !empty($rol) ){
            if(!filter_var($correo,FILTER_VALIDATE_EMAIL)){
                echo "<script> alert('Correo no valido');</script>";
            }else{
                $RegistroUsuario=$conex->prepare('INSERT INTO usuario(nombres,apellidos,documento,codigo,edad,telefono,correo,rol) VALUES(:nombre,:apellido,:documento,:codigo,:edad,:telefono,:correo,:rol)');
                $RegistroUsuario->execute(array(
                    ':nombre' =>$nombre,
                    ':apellido' =>$apellido,
                    ':documento' =>$telefono,
                    ':codigo' =>$codigo,
                    ':edad' =>$edad,
                    ':telefono' =>$telefono,
                    ':correo' =>$correo,
                    ':rol' =>$rol
                ));
                header('Location: index.html');
            }
        }else{
            echo "<script> alert('Los campos estan vacios');</script>";
        }
    }
?>

<!doctype html>

<html lang="en">

<head>
    <title>Admin ISPA</title>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

</head>

<body>


    <h1>Admin ISPA</h1>

    <h3>Crea un usuario sea Estudiante o Docente </h3>
    <hr />

    <form method="post"  method="POST">

        <input type="text" name="nombre" placeholder="Ingrese sus Nombres" required>
        <br>
        <br>
        <input type="text" name="apellido" placeholder="Ingrese sus Apellidos" required>
        <br>
        <br>
        <input type="text" name="documento" placeholder="Ingrese su Documento" required>
        <br>
        <br>
        <input type="password" name="codigo" placeholder="Ingresar Codigo" required>
        <br>
        <br>
        <input type="number" name="edad" placeholder="Ingrese su Edad" required>
        <br>
        <br>
        <input type="text" name="telefono" placeholder="Ingrese su Telefono" required>
        <br>
        <br>
        <input type="email" name="correo" aria-describedby="emailHelp" placeholder="Ingrese su correo" required>
        <br>
        <br>
        <label for="rol">Seleccione el rol:</label>
        <br>
        <br>
        <select name="rol">
            <option value="1">Admin</option>
            <option value="2">Docente</option>
            <option value="3">Estudiante</option>
        </select>
        <br>
        <br>
        <input type="submit" value="Registrar" name="registro">
    
    </form>

    <h3>Login</h3>   <hr />
    <a href="index.html" >Volver al login</a></p>

</body>

</html>