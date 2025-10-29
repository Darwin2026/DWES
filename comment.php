<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
$host = 'localhost';
$user = 'darwin';
$pass = '080119';
$dbname = 'mysitedb';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener y validar datos del formulario
$libro_id = isset($_POST['libro_id']) ? intval($_POST['libro_id']) : 0;
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$comentario = isset($_POST['comentario']) ? trim($_POST['comentario']) : '';

if ($libro_id > 0 && $nombre !== '' && $comentario !== '') {
    $stmt = $conn->prepare("INSERT INTO tComentarios (comentario, nombre, libro_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $comentario, $nombre, $libro_id);

    if ($stmt->execute()) {
        header("Location: detail.php?id=$libro_id");
        exit;
    } else {
        echo "❌ Error al insertar el comentario: " . $conn->error;
    }
} else {
    echo "⚠️ Datos incompletos. Asegúrate de rellenar todos los campos.";
}

$conn->close();
?>
