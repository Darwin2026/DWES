<?php
// login.php

$usuario = '';
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if ($usuario === 'admin' && $password === '1234') {
        $mensaje = 'Acceso concedido';
    } else {
        $mensaje = 'Acceso denegado';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login simple</title>
</head>
<body>

<h1>Inicio de sesión</h1>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <label for="usuario">Usuario:</label>
    <input type="text" id="usuario" name="usuario" required
           value="<?php echo htmlspecialchars($usuario, ENT_QUOTES, 'UTF-8'); ?>">

    <br><br>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>

    <br><br>

    <button type="submit">Entrar</button>
</form>

<?php if ($mensaje): ?>
    <p><strong><?php echo htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8'); ?></strong></p>
<?php endif; ?>

</body>
</html>
