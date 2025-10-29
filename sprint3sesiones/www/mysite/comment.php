<?php
declare(strict_types=1);

ini_set('display_errors', '1');  // En prod: '0'
error_reporting(E_ALL);

// --- Config DB ---
$host   = 'localhost';
$user   = 'darwin';
$pass   = '1234';
$dbname = 'mysitedb';
$dsn    = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

// --- Conexión PDO ---
try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    exit('Error al conectar con la base de datos.');
}

// --- Entradas ---
$libro_id   = filter_input(INPUT_POST, 'libro_id', FILTER_VALIDATE_INT);
$nombre     = trim((string)($_POST['nombre'] ?? ''));
$comentario = trim((string)($_POST['comentario'] ?? ''));

if (!$libro_id || $nombre === '' || $comentario === '') {
    http_response_code(400);
    exit('⚠️ Datos incompletos.');
}

try {
    $pdo->beginTransaction();

    // 1) Buscar usuario por nombre (si no existe, crearlo con valores mínimos)
    $selU = $pdo->prepare('SELECT id FROM tUsuarios WHERE nombre = :n LIMIT 1');
    $selU->execute([':n' => $nombre]);
    $u = $selU->fetch();

    if ($u) {
        $usuario_id = (int)$u['id'];
    } else {
        $apellidos = '';
        $email     = null; // Cambia a '' si tu columna es NOT NULL
        $pwdHash   = password_hash(bin2hex(random_bytes(8)), PASSWORD_DEFAULT);

        $insU = $pdo->prepare('INSERT INTO tUsuarios (nombre, apellidos, email, contraseña)
                               VALUES (:n, :a, :e, :p)');
        $insU->execute([
            ':n' => $nombre,
            ':a' => $apellidos,
            ':e' => $email,
            ':p' => $pwdHash
        ]);
        $usuario_id = (int)$pdo->lastInsertId();
    }

    // 2) Insertar comentario
    $insC = $pdo->prepare('INSERT INTO tComentarios (comentario, usuario_id, libro_id, fecha)
                           VALUES (:c, :uid, :lid, NOW())');
    $insC->execute([
        ':c'   => $comentario,
        ':uid' => $usuario_id,
        ':lid' => $libro_id
    ]);

    $pdo->commit();

    header('Location: detail.php?id=' . urlencode((string)$libro_id));
    exit;

} catch (PDOException $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    http_response_code(500);
    exit('❌ Error al insertar el comentario.');
}
