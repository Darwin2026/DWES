<html>
  <body>
    <h1>Carrito</h1>
    <?php
    /*Haz que se muestren los dos arrays sin usar arrays asociativos*/
      $productos = array(
        "Manzana",
        "Pan",
        "Lambo" 
      );
      $precios = array(
        0.5,
        1.2,
        1000000.0
      );

      $total = 0.0;

      echo "<table border='1'>";
      echo "<tr><th>Producto</th><th>Precio (€)</th></tr>";

      for ($i = 0; $i < count($productos); $i++) {
        $producto = $productos[$i];
        $precio = $precios[$i];

        echo "<tr>";
        echo "<td>" . $producto . "</td>";
        echo "<td>" . $precio . "</td>";
        echo "</tr>";
        $total = $total + $precio;
      }

      echo "<tr><td><b>TOTAL</b></td><td><b>" . $total . "</b></td></tr>";
      echo "</table>";
    ?>
  </body>
</html>
