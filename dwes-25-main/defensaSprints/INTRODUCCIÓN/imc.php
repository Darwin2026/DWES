<html>
  <body>
    <h1>IMC</h1>
    <p>
    <?php
    /* Haz que el usuario pueda introducir su edad, peso y altura por GET*/
      function calcular_imc($peso, $altura) {
        return $peso / ($altura * $altura);
      }

      if (isset($_GET["peso"]) && isset($_GET["altura"]) && isset($_GET["edad"])) {
        $peso = $_GET["peso"];
        $altura = $_GET["altura"];
        $edad = $_GET["edad"];

        if (!is_numeric($peso) || !is_numeric($altura) || !is_numeric($edad)) {
          echo "Todos los valores deben ser numéricos.";
        } else {
          $imc = calcular_imc($peso, $altura);

          echo "Edad: " . $edad . " años<br>";
          if ($imc < 18.5) {
            echo "IMC: " . $imc . " → Bajo peso";
          } else if ($imc < 25) {
            echo "IMC: " . $imc . " → Normal";
          } else {
            echo "IMC: " . $imc . " → Sobrepeso";
          }
        }
      } else {
        echo "Proporciona edad, peso y altura por GET.";
      }
    ?>
    </p>

    <form method="get">
      <label for="edad">Edad:</label><br>
      <input type="text" id="edad" name="edad"><br>

      <label for="peso">Peso (kg):</label><br>
      <input type="text" id="peso" name="peso"><br>

      <label for="altura">Altura (m):</label><br>
      <input type="text" id="altura" name="altura"><br><br>

      <input type="submit" value="Calcular IMC">
    </form>
  </body>
</html>
