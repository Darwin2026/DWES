<?php
$host = 'localhost';
$usuario = 'root';
$contrasena = '1234';
$bd = 'mysitedb';

$conn = new mysqli($host, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
echo "Conexión exitosa a la base de datos.";
?>
