<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$user = 'darwin';
$pass = '080119';
$dbname = 'mysitedb';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$stmt = $conn->prepare("SELECT * FROM tLibros WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$libro = $stmt->get_result()->fetch_assoc();

if (!$libro) {
    echo "Libro no encontrado.";
    exit;
}

echo "<h2>{$libro['nombre']}</h2>";
echo "<img src='{$libro['url_imagen']}' style='width:200px;height:300px;'><br>";
echo "<p><strong>Autor:</strong> {$libro['autor']}</p>";
echo "<p><strong>Año:</strong> {$libro['año_publicacion']}</p>";

$sql = "SELECT c.comentario, c.fecha, u.nombre AS usuario
        FROM tComentarios c
        JOIN tUsuarios u ON c.usuario_id = u.id
        WHERE c.libro_id = ?
        ORDER BY c.fecha DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$comentarios = $stmt->get_result();

echo "<h3>Comentarios:</h3>";
if ($comentarios->num_rows > 0) {
    while ($row = $comentarios->fetch_assoc()) {
        echo "<div style='border:1px solid #ccc; padding:10px; margin:10px 0;'>";
        echo "<strong>{$row['usuario']}</strong> ({$row['fecha']}):<br>";
        echo htmlspecialchars($row['comentario']);
        echo "</div>";
    }
} else {
    echo "<p>No hay comentarios aún.</p>";
}
?>

<h3>Añadir comentario</h3>
<form method="POST" action="comment.php">
    <input type="hidden" name="libro_id" value="<?php echo $libro_id; ?>">
    <label>Tu nombre:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Comentario:</label><br>
    <textarea name="comentario" rows="4" required></textarea><br><br>

    <button type="submit">Enviar comentario</button>
</form>


<?php
$conn->close();
?>
