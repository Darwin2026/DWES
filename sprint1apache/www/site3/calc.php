<?php
// calc.php

$num1 = '';
$num2 = '';
$operacion = 'suma';
$resultado = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num1_raw = isset($_POST['num1']) ? trim($_POST['num1']) : '';
    $num2_raw = isset($_POST['num2']) ? trim($_POST['num2']) : '';
    $operacion = isset($_POST['operacion']) ? $_POST['operacion'] : 'suma';

    $num1_clean = str_replace(',', '.', $num1_raw);
    $num2_clean = str_replace(',', '.', $num2_raw);

    if ($num1_clean === '' || $num2_clean === '' || !is_numeric($num1_clean) || !is_numeric($num2_clean)) {
        $error = 'Por favor introduce dos números válidos.';
    } else {
        $a = floatval($num1_clean);
        $b = floatval($num2_clean);

        switch ($operacion) {
            case 'suma':
                $resultado = $a + $b;
                break;
            case 'resta':
                $resultado = $a - $b;
                break;
            case 'multiplicacion':
                $resultado = $a * $b;
                break;
            case 'division':
                if ($b == 0) {
                    $error = 'No se puede dividir entre cero.';
                } else {
                    $resultado = $a / $b;
                }
                break;
            default:
                $error = 'Operación no válida.';
        }

        if (!$error) {
            $resultado_texto = number_format($a, 2, ',', '.') . " ";
            switch ($operacion) {
                case 'suma': $resultado_texto .= "+ "; break;
                case 'resta': $resultado_texto .= "- "; break;
                case 'multiplicacion': $resultado_texto .= "× "; break;
                case 'division': $resultado_texto .= "÷ "; break;
            }
            $resultado_texto .= number_format($b, 2, ',', '.') . " = " . number_format($resultado, 2, ',', '.');
        }
    }

    $num1 = $num1_raw;
    $num2 = $num2_raw;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calculadora simple</title>
</head>
<body>

<h1>Calculadora simple</h1>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <label for="num1">Primer número:</label>
    <input type="number" name="num1" id="num1" step="any" required
           value="<?php echo htmlspecialchars($num1, ENT_QUOTES, 'UTF-8'); ?>">

    <label for="num2">Segundo número:</label>
    <input type="number" name="num2" id="num2" step="any" required
           value="<?php echo htmlspecialchars($num2, ENT_QUOTES, 'UTF-8'); ?>">

    <label for="operacion">Operación:</label>
    <select name="operacion" id="operacion">
        <option value="suma" <?php if ($operacion === 'suma') echo 'selected'; ?>>Suma</option>
        <option value="resta" <?php if ($operacion === 'resta') echo 'selected'; ?>>Resta</option>
        <option value="multiplicacion" <?php if ($operacion === 'multiplicacion') echo 'selected'; ?>>Multiplicación</option>
        <option value="division" <?php if ($operacion === 'division') echo 'selected'; ?>>División</option>
    </select>

    <button type="submit">Calcular</button>
</form>

<?php if ($error): ?>
    <p><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
<?php elseif (!empty($resultado_texto)): ?>
    <p><strong><?php echo htmlspecialchars($resultado_texto, ENT_QUOTES, 'UTF-8'); ?></strong></p>
<?php endif; ?>

</body>
</html>
