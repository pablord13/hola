<?php
$servername = "localhost";
$username = "parodi";
$password = "2380";
$dbname = "pabloexamen";

// Crear connexió
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprovar connexió
if ($conn->connect_error) {
  die("Connexió fallida: " . $conn->connect_error);
}

function dibuix($ample) {
  // Crear dibuix
  $result = '';
  for ($i = $ample; $i >= 1; $i--) {
    for ($j = $i; $j >= 1; $j--) {
      $result .= "*";
    }
    $result .= "<br>";
  }

  for ($i = 2; $i <= $ample; $i++) {
    for ($j = 1; $j <= $i; $j++) {
      $result .= "*";
    }
    $result .= "<br>";
  }
  return $result;
}

echo "<h1>Asterisk Art Generator</h1>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $ample = $_POST["ample"];

  echo dibuix($ample);

  // Guardar a la base de dades
  $sql = "INSERT INTO MyTable (date, ample) VALUES (CURRENT_TIMESTAMP, $ample)";

  if ($conn->query($sql) === TRUE) {
    echo "Registre guardat amb èxit";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Ample del dibuix: <input type="number" name="ample">
  <input type="submit">
</form>
