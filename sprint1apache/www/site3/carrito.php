<?php
$carrito = array(
    "Iphone" => 1200,
    "Samsung s26" => 1300,
    "Garmin Venus" => 499,
    "Suunto Race S" => 349
);

$total =0;
foreach ($carrito as $precio){
    $total += $precio;
}
?> 
<!Doctype html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Carrito de compras</title>
        <style>
            table{
                border-collapse: collapse;
                width: 8px;
            }
            th,td{
                border: 1px solid #444;
                padding: 8px;
                text-align: left;
            }
            th{
                background-color: green;

            }
            tfoot td{
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <h2>Carrito de compras Darwin Argueta</h2>
        <table>
            <thead>
                <tr>
                    <th>Productos</th>
                    <th>Precios (€)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($carrito as $producto => $precio): ?>
                    <tr>
                        <td><?php echo $producto; ?></td>
                        <td><?php echo number_format($precio, 2, ',','.'); ?>€</td>
                    </tr>
                    <?php endforeach; ?>
            </tbody>
            </tfoot>
            <tr>
                <td>Total</td>
                <td><?php echo number_format($total,2,',','.'); ?>€</td>
            </tr>
        </tfoot>
        </table>
    </body>
</html>