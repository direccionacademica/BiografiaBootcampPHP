<?php

$bd = "adminispa";
$user = 'root';
$pass = '';
$hostname = "localhost";

try {

    $conex = new PDO('mysql:host=localhost;dbname='.$bd, $user, $pass);

} catch (PDOException $e) {

   echo "Se produjo el siguiente error al conectar con MySQL".$e->getMessage();

}

?>