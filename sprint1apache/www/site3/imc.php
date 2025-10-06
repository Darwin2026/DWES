<?php
function calcular_imc($peso, $altura) {
    if ($altura == 0) {
        return 0; // evitar división por cero
    }
    return $peso / ($altura * $altura);
}

// Obtener los parámetros GET
$peso = isset($_GET['peso']) ? floatval($_GET['peso']) : 0;
$altura = isset($_GET['altura']) ? floatval($_GET['altura']) : 0;

$imc = calcular_imc($peso, $altura);

// Función para obtener mensaje según IMC
function mensaje_imc($imc) {
    if ($imc == 0) {
        return "Por favor, ingresa peso y altura válidos.";
    } elseif ($imc < 18.5) {
        return "Bajo peso";
    } elseif ($imc >= 18.5 && $imc <= 24.9) {
        return "Normal";
    } else {
        return "Sobrepeso";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calculadora IMC</title>
</head>
<body>
    <h1>Calculadora de IMC</h1>

    <?php if ($peso > 0 && $altura > 0): ?>
        <p>Peso: <?php echo $peso; ?> kg</p>
        <p>Altura: <?php echo $altura; ?> m</p>
        <p>IMC: <?php echo number_format($imc, 2); ?></p>
        <p>Resultado: <strong><?php echo mensaje_imc($imc); ?></strong></p>
    <?php else: ?>
        <p>Por favor, ingresa los parámetros <code>peso</code> y <code>altura</code> en la URL, por ejemplo:</p>
        <p><code>?peso=70&altura=1.75</code></p>
    <?php endif; ?>

</body>
</html>
