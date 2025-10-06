<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Tabla de multiplicar del 7</title>
    <style>
            table{
                 border-collapse: collapse;
                 width: 300;
            }
            td, th{
                border: 1px solid #444;
                padding: 8;
                text-align: center;
            }
            th{
                background-color: #eee;
            }
    </style>
</head>
<body>
    <h1>tabla de multiplicar del 7</h1>
    <table>
        <tr>
            <th>multiplicación</th>
            <th>resultado</th>
        </tr>
            <?php
            for ($i = 1; $i <= 10; $i++){
                $resultado = 7 * $i;
                echo "<tr><td>7 x $i</td><td>$resultado</td></tr>";
            }
            ?>
    </table>

</body>

</html>