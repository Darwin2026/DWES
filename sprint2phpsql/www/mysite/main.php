<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "esto que esssssssssss;";

$host = 'localhost';
$user = 'root';
$pass = '1234';
$dbname = 'mysitedb';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM tLibros";
$result = $conn->query($sql);

echo '<style>
.card {
    border: 1px so1apachelid #ccc;
    padding: 10px;
    margin: 10px;
    width: 220px;
    display: inline-block;
    vertical-align: top;
    text-align: center;
    box-shadow: 2px 2px 5px rgba(0,0,0,0.2);
}
.card img {
    width: 150px;
    height: 200px;
    object-fit: cover;
    margin-bottom: 10px;
}
</style>';

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="card">';
        echo '<img src="' . htmlspecialchars($row["url_imagen"]) . '" alt="Imagen">';
        echo '<h3>' . htmlspecialchars($row["nombre"]) . '</h3>';
        echo '<p><strong>Autor:</strong> ' . htmlspecialchars($row["autor"]) . '</p>';
        echo '<p><strong>Año:</strong> ' . htmlspecialchars($row["año_publicacion"]) . '</p>';
        echo '<a href="detail.php?id=' . $row["id"] . '">Ver más</a>';
        echo '</div>';
    }
} else {
    echo "No hay libros disponibles.";
}

$conn->close();
?>
