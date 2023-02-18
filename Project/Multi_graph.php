<!DOCTYPE html>

<head>
  <title>Oilgear - module 2</title>
  <link href="Style/accueil.css" rel="stylesheet" type="text/css" />
  <link href="Style/style_input.css" rel="stylesheet" type="text/css" />
  <link rel="icon" type="image/png" href="Images/Oilgear_icon.png" />
  <meta charset="utf-8" />
</head>

<body>
  <?php include("Header.php"); ?>

  <div class="page">
    <div class="display">
      <h1>Module 2 - Multi oil graphics</h1>
      <form action="Multi_graph2.php" method="post">
        <?php
        $value = isset($_POST["number"]) ? $_POST["number"] : "";
        $servername = "sql7.freesqldatabase.com";
        $username = "sql7596246";
        $password = "HWEBqf5tTT";
        $dbname = "sql7596246";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        $sql2 = "SELECT Name_fluid FROM fluid_data_oil";
        $tableau = array();
        $result2 = $conn->query($sql2);
        if ($result2->num_rows > 0) {
          while ($row = $result2->fetch_assoc()) {
            $tableau[] = $row['Name_fluid'];
          }
        } else {
          echo "0 results";
        }

        for ($i = 0; $i < $value; $i++) {
          $name = "comboboxoil$i";
          $name2 = "choice$i";
          echo "<select name=$name>";
          echo "<option selected value='0'>Select your oil</option>";
          foreach ($tableau as $namee) {
            echo "<option value='" . $namee . "'>" . $namee . "</option>";
          }
          echo "</select>";
          echo "<br>";

        ?>
          <div class="middle">
            <label class="rad-label">
              <input type="checkbox" class="rad-input" id="check1_<?php echo "$i"; ?>" name="options" value="1" onclick="check(<?php echo '$i'; ?>)">
              <div class="rad-design"></div>
              <div class="rad-text">v = F(T)</div>
            </label>
            <label class="rad-label">
              <input type="checkbox" class="rad-input" id="check2_<?php echo "$i"; ?>" name="options" value="2" onclick="check(<?php echo '$i'; ?>)">
              <div class="rad-design"></div>
              <div class="rad-text">v = F(P)</div>
            </label>
            <script>
              function check(i) {
                var checkbox1 = document.getElementById("check1_"+i);
                var checkbox2 = document.getElementById("check2_"+i);

                if (checkbox1.checked) {
                  document.getElementById("check2").checked = false;
                }
                if (checkbox2.checked) {
                  document.getElementById("check1").checked = false;
                }
              }
            </script>
          </div>
        <?php
          echo "<br>";
          echo "<br>";
        }
        echo "<input type=hidden name=value value=$value>";
        $conn->close();
        ?>
        <button type="submit" name="button1">Submit</button>
      </form>
    </div>
  </div>

</body>

</html>