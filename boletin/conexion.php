<?php
$servername = "localhost"; //nombre del servidor
$username = "root";//nombre de usuario
$password = "";//contraseña
$database = "boletin"; //bdd que se va a usar 

$con = new mysqli($servername, $username, $password, $database); //crea la coneccion
if ($con->connect_error) { //si hay un error
    die("error de conexion:". $con->connect_error); //muestra el mensaje y termina la ejecucion 
}
?>
