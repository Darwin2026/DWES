<?php
$cantidad= '';
$direccion= '';
$resultado_texto ='';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar datos enviados
    $cantidad_raw = isset($_POST['cantidad']) ? trim($_POST['cantidad']) : '';
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : 'c2f';

    // Permitir que el usuario use coma decimal (p.ej. "25,5") -> cambiar a punto
    $cantidad_clean = str_replace(',', '.', $cantidad_raw);

    if ($cantidad_clean === '' || !is_numeric($cantidad_clean)) {
        $error = 'Por favor introduce un número válido.';
    } else {
        // Convertir a float
        $valor = floatval($cantidad_clean);

        // Realizar conversión
        if ($direccion === 'c2f') {
            // Fórmula: ºF = (ºC × 9/5) + 32
            $converted = ($valor * 9 / 5) + 32;
            $resultado_texto = number_format($valor, 2, ',', '.') . " °C = " . number_format($converted, 2, ',', '.') . " °F";
        } else {
            // Fórmula: ºC = (ºF - 32) × 5/9
            $converted = ($valor - 32) * 5 / 9;
            $resultado_texto = number_format($valor, 2, ',', '.') . " °F = " . number_format($converted, 2, ',', '.') . " °C";
        }
    }
    $cantidad = $cantidad_raw;
}

?>

<!Doctype html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Conversor de temperaturas</title>
    </head>
    <body>
        <h1>Conversor de temperatura D.Argueta</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label for="cantidad">Cantidad (numero):</label>
            <input type="number" id="cantidad" name="cantidad" step="any" require  
                value="<?php echo htmlspecialchars($cantidad, ENT_QUOTES, 'UTF-8'); ?>">
            <p>
            <label>
                <input type="radio" name="direccion" value="c2f" <?php if ($direccion === 'c2f') echo 'checked'; ?>>
                Celsius → Fahrenheit
            </label>
            <label>
                <input type="radio" name="direccion" value="f2c" <?php if ($direccion === 'f2c') echo 'checked'; ?>>
                Fahrenheit → Celsius
            </label>
        </p>

        <button type="submit">Convertir</button>
    </form>

    <?php if ($error): ?>
        <p><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php elseif ($resultado_texto): ?>
        <p><?php echo htmlspecialchars($resultado_texto, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>
</body>
</html>
    </body>
</html>
