<!DOCTYPE html>

<form action="Multi_graph3.php" method="post">
  <?php

  $value = isset($_POST["value"]) ? $_POST["value"] : "";
  for ($i = 0; $i < $value; $i++) {
    ${"name$i"} = isset($_POST["comboboxoil$i"]) ? $_POST["comboboxoil$i"] : "";
    ${"choice$i"} = isset($_POST["choice$i"]) ? $_POST["choice$i"] : "";
  }

  for ($i = 0; $i < $value; $i++) {
    $name = ${"name$i"};
    if (${"choice$i"} == "v=f(T)") {
      echo "For the $name you choose v=f(T) <br>";
      echo "<label>v=f(T) with P constant with T= <input type='text' name='min$i' id='min1' placeholder='min T'> to <input type='text' name='max$i' id='max1' placeholder='max T'> for P equal to : <input type='text' name='var$i' id='P' placeholder='pressure'>";
      echo "<input type=hidden name=choice$i value=v=f(T)>";
      echo "<br>";
      echo "<br>";
    } else {
      echo "For the $name you choose v=f(P) <br>";
      echo "<label>v=f(P) with T constant with P= <input type='text' name='min$i' id='min2' placeholder='min P'> to <input type='text' name='max$i' id='max2' placeholder='max P'> for T equal to : <input type='text' name='var$i' id='T' placeholder='temperature'>";
      echo "<input type=hidden name=choice$i value=v=f(P)>";
      echo "<br>";
      echo "<br>";
    }
  }

  for ($i = 0; $i < $value; $i++) {
    $namee = ${"name$i"};
    $choix = ${"choice$i"};
    $name = "comboboxoil$i";
    echo "<select name=$name style='display:none'>";
    echo "<option value='" . $namee . "'>" . $namee . "</option>";
    echo "</select>";
    echo "<input type=hidden name=choix$i value=$choix>";
  }
  echo "<input type=hidden name=value value=$value>";
  ?>
  <button type="submit">Graph</button>
</form>