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

// Validar parámetro ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    die("ID inválido.");
}

// Obtener datos del libro
$sqlLibro = "SELECT * FROM tLibros WHERE id = $id";
$resultLibro = $conn->query($sqlLibro);
if ($resultLibro->num_rows === 0) {
    die("Libro no encontrado.");
}
$libro = $resultLibro->fetch_assoc();

// Obtener comentarios
$sqlComentarios = "SELECT c.comentario, c.fecha, CONCAT(u.nombre, ' ', u.apellidos) AS usuario
                   FROM tComentarios c
                   LEFT JOIN tUsuarios u ON c.usuario_id = u.id
                   WHERE c.libro_id = $id
                   ORDER BY c.fecha DESC";
$resultComentarios = $conn->query($sqlComentarios);
if (!$resultComentarios) {
    die("Error en la consulta de comentarios: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle del libro</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        img { width: 200px; height: 200px; object-fit: cover; }
        .comentario { border-top: 1px solid #ccc; margin-top: 10px; padding-top: 10px; }
        textarea { width: 100%; }
    </style>
</head>
<body>

    <h1><?= htmlspecialchars($libro['nombre']) ?></h1>
    <img src="<?= htmlspecialchars($libro['url_imagen']) ?>" alt="Imagen del libro">
    <p><strong>Autor:</strong> <?= htmlspecialchars($libro['autor']) ?></p>
    <p><strong>Año de publicación:</strong> <?= $libro['año_publicacion'] ?></p>

    <h2>Comentarios</h2>
    <?php if ($resultComentarios->num_rows > 0): ?>
        <?php while ($comentario = $resultComentarios->fetch_assoc()): ?>
            <div class="comentario">
                <p><strong><?= htmlspecialchars($comentario['usuario'] ?? 'Anónimo') ?>:</strong> <?= htmlspecialchars($comentario['comentario']) ?></p>
                <small><?= $comentario['fecha'] ?></small>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay comentarios aún.</p>
    <?php endif; ?>

    <h3>Deja un nuevo comentario</h3>
    <form action="comment.php" method="POST">
        <textarea name="new_comment" rows="4" placeholder="Escribe tu comentario..."></textarea><br>
        <input type="hidden" name="libro_id" value="<?= $id ?>">
        <input type="submit" value="Comentar">
    </form>

</body>
</html>

<?php $conn->close(); ?>